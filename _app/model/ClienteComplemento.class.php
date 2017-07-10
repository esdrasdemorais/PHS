<?php

/**
 * ClienteComplemento.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class ClienteComplemento
{
    private $id;
    private $cliente;
    private $endereco;
    private $complemento;
    
    function getId() {
        return $this->id;
    }

    function getCliente() {
        return $this->cliente;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getComplemento() {
        return $this->complemento;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function setCliente(cliente $cliente) {
        $this->cliente = $cliente;
    }

    function setEndereco(Endereco $endereco) {
        $this->endereco = $endereco;
    }

    function setComplemento($complemento) {
        $this->complemento = $complemento;
    }
}
