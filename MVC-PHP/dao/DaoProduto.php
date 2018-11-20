<?php

/**
 *
 * @author Pedro Smith Enju
 */
class DaoProduto implements IDao {

    public function excluir($model) {
        $sql = "delete from produto where id_produto=:ID";
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

        $sql = "select * from produto where id_produto=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("ID", $p1);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $pro = $sth->fetchObject("Produto");
        $dc = new DaoCategoria();
        if ($pro->id_categoria) {
            $cat = $dc->listar($pro->id_categoria);
            $pro->setCategoria($cat);
        }
        return $pro;
    }

    public function listarTodos() {
        $sql = "select * from produto";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        $arPro = array();
        while ($pro = $sth->fetchObject("Produto")) {

            $arPro[] = $pro;
        }
        return $arPro;
    }

    public function salvar($model) {
        $id = 0;
        $nome = $model->getNome_produto();
        $valor = str_replace(",", ".", $model->getValor());
        $status = $model->getStatus();
        $categoria = $model->getCategoria();
        if ($categoria instanceof Categoria) {
            $id_categoria = $categoria->getId_categoria();
        }

        if ($model->getId_produto()) {
            $id = $model->getId_produto();
            $sql = "update produto set nome_produto=:nome, valor=:valor, "
                    . "status=:status, id_categoria=:id_categoria where id_produto=:id";
        } else {
            $sql = "insert into produto(id_produto,nome_produto,valor,status, id_categoria) values "
                    . "(:id,:nome,:valor,:status, :id_categoria)";
        }
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("id", $id);
        $sth->bindParam("nome", $nome);
        $sth->bindParam("valor", $valor);
        $sth->bindParam("status", $status);
        $sth->bindParam("id_categoria", $id_categoria);
        try {
            $sth->execute();
            return $model;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }

}
