<?php

/**
 * Description of DaoUsuario
 *
 * @author Administrador
 */
class DaoUsuario implements IDao {

    public function excluir($model) {
        $sql = "delete FROM usuario where id=:ID";
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

    /**
     * 
     * @param int $p1
     * @return Usuario
     */
    public function listar($p1) {

        $sql = "SELECT id, nome, login, senha, status, thumbnail_path, id_empresa FROM usuario where id=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("ID", $p1);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $usu = $sth->fetchObject("Usuario");
        $de = new DaoEmpresa();
        if ($usu->id_empresa) {
            $emp = $de->listar($usu->id_empresa);
            $usu->setEmpresa($emp);
        }
        return $usu;
    }

    /**
     * 
     * @param int $p1
     * @return ArrayObject
     */
    public function getPath($login) {

        $sql = "SELECT thumbnail_path FROM usuario where login=:login";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("login", $login);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $res = $sth->fetch();
        if ($res) {
            return $res['thumbnail_path'];
        } else {
            return null;
        }
    }

    public function listarTodos() {
        $sql = "SELECT id, nome, login, senha, status, thumbnail_path, id_empresa FROM usuario";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $arUsu = array();
        while ($usu = $sth->fetchObject("Usuario")) {

            $arUsu[] = $usu;
        }
        return $arUsu;
    }

    public function salvar($model) {
        $nome = $model->getNome();
        $login = $model->getLogin();
        $senha = $model->getSenha();
        $status = $model->getStatus();
        $thumb = $model->getThumbnail_path();
        $id_empresa = null;
        $empresa = $model->getEmpresa();
        if ($empresa instanceof Empresa) {
            $id_empresa = $empresa->getId();
        }

        if ($model->getId()) {
            $id = $model->getId();
            $sql = "update usuario set nome=:nome, login=:login, senha=:senha, "
                    . "status=:status, thumbnail_path=:thumbnail_path, id_empresa=:id_empresa where id=:id";
        } else {
            $id = $this->generateID();
            $model->setId($id);
            $sql = "insert into usuario(id,nome,login,senha,status, thumbnail_path, id_empresa) values "
                    . "(:id,:nome, :login,:senha,:status, :thumbnail_path, :id_empresa)";
        }
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("id", $id);
        $sth->bindParam("nome", $nome);
        $sth->bindParam("login", $login);
        $sth->bindParam("senha", $senha);
        $sth->bindParam("status", $status);
        $sth->bindParam("thumbnail_path", $thumb);
        $sth->bindParam("id_empresa", $id_empresa);
        try {
            $sth->execute();
            return $model;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }

    /**
     * 
     * @return int
     */
    private function generateID() {
        $sql = "select (coalesce(max(id),0)+1) as ID from usuario";
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
        $res = $sth->fetch();
        $id = $res['ID'];
        return $id;
    }

    public function autenticar($login, $senha) {
        $sql = "select * from usuario where login=:LOGIN and senha=:SENHA";
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("LOGIN", $login);
        $sth->bindParam("SENHA", $senha);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
        $res = $sth->fetchObject("Usuario");
        return $res;
    }

}
