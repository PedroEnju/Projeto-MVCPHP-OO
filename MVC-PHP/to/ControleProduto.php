<?php

/**
 *
 * @author Pedro Smith Enju
 */
class ControleProduto implements IPrivateTO {

    public function listaDeProduto() {
        $dp = new DaoProduto();
        $produtos = $dp->listarTodos();
        $v = new TGui("listaDeProduto");
        $v->addDados("produtos", $produtos);
        $v->renderizar();
    }

    public function editar($id) {
        $p1 = $id[2];
        $dp = new DaoProduto();
        $u = $dp->listar($p1);
        $v = new TGui("formularioProduto");
        $v->addDados("produto", $u);
        $v->addDados("categorias", $this->getCategorias());
        $v->renderizar();
    }

    private function getCategorias() {
        $dc = new DaoCategoria();
        return $dc->listarTodos();
    }

    public function novo() {
        $u = new Produto();
        $v = new TGui("formularioProduto");
        $v->addDados("produto", $u);
        $v->addDados("categorias", $this->getCategorias());
        $v->renderizar();
    }

    public function salvar() {
        $p = new Produto();
        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        if (trim($id) != "") {
            $p->setId_produto($id);
        }
        $nome = isset($_POST['nome']) ? $_POST['nome'] : FALSE;
        if (!$nome || trim($nome) == "") {
            throw new Exception("O campo nome é obrigatório!");
        }
        $valor = isset($_POST['valor']) ? $_POST['valor'] : FALSE;
        if (!$valor || trim($valor) == "") {
            throw new Exception("O campo valor é obrigatório!");
        }
        $status = isset($_POST['status']) ? $_POST['status'] : FALSE;
        if (!$status || trim($status) == "") {
            throw new Exception("O campo status é obrigatório!");
        }
        $cat = isset($_POST['categoria']) ? $_POST['categoria'] : FALSE;
        if (!$cat) {
            throw new Exception("A empresa é obrigatória");
        } else {
            $de = new DaoCategoria();
            $categoria = $de->listar($cat);
            if ($categoria instanceof Categoria) {
                $p->setCategoria($categoria);
            }
        }
        $p->setNome_produto($nome);
        $p->setValor($valor);
        $p->setStatus($status);

        $dp = new DaoProduto();
        $pro = $dp->salvar($p);

        if ($pro instanceof Produto) {
            header("location: " . URL . "controle-produto/lista-de-produto");
        } else {
            echo "Não foi possivel salvar o produto";
        }
    }

    public function excluir($id) {
        $p1 = $id[2];
        $dp = new DaoProduto();
        $p = $dp->listar($p1);
        $v = new TGui("confirmaExclusaoProduto");
        $v->addDados("produto", $p);
        $v->renderizar();
    }

    public function confirmaExclusao() {
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        if ($id) {
            $dp = new DaoProduto();
            $p = $dp->listar($id);
            if ($dp->excluir($p)) {
                header("location: " . URL . "controle-produto/lista-de-produto");
            } else {
                echo "Não foi possível excluir o registro!";
            }
        } else {
            header("location: " . URL . "controle-produto/lista-de-produto");
        }
    }

}
