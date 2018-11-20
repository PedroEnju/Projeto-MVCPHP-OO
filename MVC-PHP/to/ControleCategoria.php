<?php

/**
 *
 * @author Pedro Smith Enju
 */
class ControleCategoria implements IPrivateTO {

    public function listaDeCategoria() {
        $de = new DaoCategoria();
        $cat = $de->listarTodos();
        $v = new TGui("listaDeCategoria");
        $v->addDados("categorias", $cat);
        $v->renderizar();
    }

    public function editar($id) {
        $p1 = $id[2];
        $dc = new DaoCategoria();
        $c = $dc->listar($p1);
        $v = new TGui("formularioCategoria");
        $v->addDados("categoria", $c);
        $v->renderizar();
    }

    public function novo() {
        $c = new Categoria();
        $v = new TGui("formularioCategoria");
        $v->addDados("categoria", $c);
        $v->renderizar();
    }

    public function salvar() {

        $e = new Categoria();
        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        if (trim($id) != "") {
            $e->setId_categoria($id);
        }
        $nome = isset($_POST['nome']) ? $_POST['nome'] : FALSE;
        if (!$nome || trim($nome) == "") {
            throw new Exception("O campo nome é obrigatório!");
        }
        $e->setNome_categoria($nome);

        $dc = new DaoCategoria();
        $dc->salvar($e);

        header("location: " . URL . "controle-categoria/lista-de-categoria");
    }

    public function excluir($id) {
        $p1 = $id[2];
        $dc = new DaoCategoria();
        $e = $dc->listar($p1);
        $v = new TGui("confirmaExclusaoCategoria");
        $v->addDados("categoria", $e);
        $v->renderizar();
    }

    public function confirmaExclusao() {
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        if ($id) {
            $dc = new DaoCategoria();
            $e = $dc->listar($id);
            if ($dc->excluir($e)) {
                header("location: " . URL . "controle-categoria/lista-de-categoria");
            } else {
                throw new Exception("Não foi possível excluir o registro!");
            }
        } else {
            header("location: " . URL . "controle-categoria/lista-de-categoria");
        }
    }

}
