<?php

/**
 * Babysitter.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class ServicoEndereco
{
    private $id;
    private $servico;
    private $endereco;
    private $complemento;
    private $descricao;
        
    function getId() {
        return $this->id;
    }

    function getServico() {
        return $this->servico;
    }

    function getEndereco() {
        return $this->endereco;
    }
    
    function getComplemento() {
        return $this->complemento;
    }

    function getDescricao() {
        return $this->descricao;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function setServico(Servico $servico) {
        $this->servico = $servico;
    }

    function setEndereco(Endereco $endereco) {
        $this->endereco = $endereco;
    }

    function setComplemento(Complemento $complemento) {
        $this->complemento = $complemento;
    }

    function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

}
