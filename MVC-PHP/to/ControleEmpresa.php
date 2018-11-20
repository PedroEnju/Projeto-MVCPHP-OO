<?php

/**
 *
 * @author Pedro Smith Enju
 */
class ControleEmpresa implements IPrivateTO {

    public function listaDeEmpresa() {
        $de = new DaoEmpresa();
        $empresas = $de->listarTodos();
        $v = new TGui("listaDeEmpresa");
        $v->addDados("empresas", $empresas);
        $v->renderizar();
    }

    public function editar($id) {
        $p1 = $id[2];
        $de = new DaoEmpresa();
        $e = $de->listar($p1);
        $v = new TGui("formularioEmpresa");
        $v->addDados("empresa", $e);
        $v->renderizar();
    }

    public function novo() {
        $e = new Empresa();
        $v = new TGui("formularioEmpresa");
        $v->addDados("empresa", $e);
        $v->renderizar();
    }

    public function salvar() {

        $e = new Empresa();
        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        if (trim($id) != "") {
            $e->setId($id);
        }
        $nome = isset($_POST['nome']) ? $_POST['nome'] : FALSE;
        if (!$nome || trim($nome) == "") {
            throw new Exception("O campo nome é obrigatório!");
        }
        $status = isset($_POST['status']) ? $_POST['status'] : FALSE;
        if (!$status || trim($status) == "") {
            throw new Exception("O campo status é obrigatório!");
        }
        $e->setNome($nome);
        $e->setStatus($status);

        $de = new DaoEmpresa();
        $de->salvar($e);

        header("location: " . URL . "controle-empresa/lista-de-empresa");
    }

    public function excluir($id) {
        $p1 = $id[2];
        $de = new DaoEmpresa();
        $e = $de->listar($p1);
        $v = new TGui("confirmaExclusaoEmpresa");
        $v->addDados("empresa", $e);
        $v->renderizar();
    }

    public function confirmaExclusao() {
        $id = isset($_POST['id']) ? $_POST['id'] : false;
        if ($id) {
            $de = new DaoEmpresa();
            $e = $de->listar($id);
            if ($de->excluir($e)) {
                header("location: " . URL . "controle-empresa/lista-de-empresa");
            } else {
                throw new Exception("Não foi possível excluir o registro!");
            }
        } else {
            header("location: " . URL . "controle-empresa/lista-de-empresa");
        }
    }

}
