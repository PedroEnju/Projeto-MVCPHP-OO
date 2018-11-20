<?php

/**
 *
 * @author Pedro Smith Enju
 */
class DaoEmpresa implements IDao {

    public function excluir($model) {
        $sql = "delete from empresa where id_empresa=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $p1 = $model->getId();
        $sth->bindParam("ID", $p1);
        try {
            $sth->execute();
            return true;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }

    public function listar($p1) {
        $sql = "select * from empresa where id_empresa=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("ID", $p1);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $emp = $sth->fetchObject("Empresa");
        return $emp;
    }

    public function listarTodos() {
        $sql = "select * from empresa";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $arEmp = array();
        while ($emp = $sth->fetchObject("Empresa")) {

            $arEmp[] = $emp;
        }
        return $arEmp;
    }

    public function salvar($model) {
        $id = 0;
        $nome = $model->getNome();
        $status = $model->getStatus();

        if ($model->getId()) {
            $id = $model->getId();
            $sql = "update empresa set nome_empresa=:nome, status=:status where id_empresa=:id";
        } else {
            $sql = "insert into empresa(id_empresa,nome_empresa,status) values "
                    . "(:id,:nome,:status)";
        }
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("id", $id);
        $sth->bindParam("nome", $nome);
        $sth->bindParam("status", $status);
        try {
            $sth->execute();
            return $model;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }

}
