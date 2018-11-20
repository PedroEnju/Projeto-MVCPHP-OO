<?php

/**
 *
 * @author Pedro Smith Enju
 */
class Empresa {

    private $id_empresa;
    private $nome_empresa;
    private $status;

    function getId() {
        return $this->id_empresa;
    }

    function getNome() {
        return $this->nome_empresa;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id_empresa = $id;
    }

    function setNome($nome) {
        $this->nome_empresa = $nome;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}
