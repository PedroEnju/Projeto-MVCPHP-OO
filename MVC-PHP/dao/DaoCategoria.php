<?php

/**
 *
 * @author Pedro Smith Enju
 */
class DaoCategoria implements IDao {

    public function excluir($model) {
        $sql = "delete from categoria where id_categoria=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $p1 = $model->getId_categoria();
        $sth->bindParam("ID", $p1);
        try {
            $sth->execute();
            return true;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }

    public function listar($p1) {
        $sql = "select * from categoria where id_categoria=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("ID", $p1);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $emp = $sth->fetchObject("Categoria");
        return $emp;
    }

    public function listarTodos() {
        $sql = "select * from categoria";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $arEmp = array();
        while ($emp = $sth->fetchObject("Categoria")) {

            $arEmp[] = $emp;
        }
        return $arEmp;
    }

    public function salvar($model) {
        $id = 0;
        $nome = $model->getNome_categoria();

        if ($model->getId_categoria()) {
            $id = $model->getId_categoria();
            $sql = "update categoria set nome_categoria=:nome where id_categoria=:id";
        } else {
            $sql = "insert into categoria(id_categoria,nome_categoria) values "
                    . "(:id,:nome)";
        }
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("id", $id);
        $sth->bindParam("nome", $nome);
        try {
            $sth->execute();
            return $model;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }

}
