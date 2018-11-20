<?php

/**
 *
 * @author Pedro Smith Enju
 */
class Produto {

    private $id_produto;
    private $nome_produto;
    private $valor;
    private $status;

    /**
     *
     * @var Categoria
     */
    private $categoria;

    function getId_produto() {
        return $this->id_produto;
    }

    function getNome_produto() {
        return $this->nome_produto;
    }

    function getValor() {
        return $this->valor;
    }

    function getStatus() {
        return $this->status;
    }

    function getCategoria() {
        return $this->categoria;
    }

    function setId_produto($id_produto) {
        $this->id_produto = $id_produto;
    }

    function setNome_produto($nome_produto) {
        $this->nome_produto = $nome_produto;
    }

    function setValor($valor) {
        $this->valor = $valor;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setCategoria(Categoria $categoria) {
        $this->categoria = $categoria;
    }

}
