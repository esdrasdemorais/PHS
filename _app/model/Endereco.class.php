<?php

/**
 * Endereco.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class Endereco {
    private $id;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $estado;
    private $cep;
    private $numero;
    private $geoLocalizacao;

    function getId()
    {
        return $this->id;
    }

    function getLogradouro()
    {
        return $this->logradouro;
    }

    function getBairro()
    {
        return $this->bairro;
    }

    function getCidade()
    {
        return $this->cidade;
    }

    function getEstado()
    {
        return $this->estado;
    }

    function getCep()
    {
        return $this->cep;
    }
          
    function getNumero()
    {
        return $this->numero;
    }
    
    function getGeoLocalizacao()
    {
        return $this->geoLocalizacao;
    }
    
    function setId($id) {
        $this->id = $id;
    }
    
    function setLogradouro($logradouro) {
        $this->logradouro = $logradouro;
    }

    function setBairro($bairro) {
        $this->bairro = $bairro;
    }

    function setCidade($cidade) {
        $this->cidade = $cidade;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setCep($cep) {
        $this->cep = $cep;
    }
    
    function setNumero($numero) {
        $this->numero = $numero;
    }
    
    function setGeoLocalizacao($geoLocalizacao) {
        $this->geoLocalizacao = $geoLocalizacao;
    }
}
