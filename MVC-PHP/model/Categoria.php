<?php

/**
 *
 * @author Pedro Smith Enju
 */
class Categoria {

    private $id_categoria;
    private $nome_categoria;

    function getId_categoria() {
        return $this->id_categoria;
    }

    function getNome_categoria() {
        return $this->nome_categoria;
    }

    function setId_categoria($id_categoria) {
        $this->id_categoria = $id_categoria;
    }

    function setNome_categoria($nome_categoria) {
        $this->nome_categoria = $nome_categoria;
    }

}
