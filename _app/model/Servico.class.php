<?php

/**
 * Servico.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
abstract class Servico
{
    protected $id;
    protected $data;
    protected $hora;
    protected $periodo;
    protected $valorHora;
    protected $valorTotal;
    protected $enderecos;
    protected $cliente;
    
    function getId() {
        return $this->id;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getCliente() {
        return $this->cliente;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setEndereco(array $enderecos) {
        $this->enderecos = $enderecos;
    }

    function setCliente(Cliente $cliente) {
        $this->cliente = $cliente;
    }
    
    private function setCustoHora() {
        $this->valorTotal = $this->hora * $this->valorHora;
    }
    
    function getData() {
        return $this->data;
    }

    function getHora() {
        return $this->hora;
    }

    function getPeriodo() {
        return $this->periodo;
    }

    function getValorHora() {
        return $this->valorHora;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setPeriodo($periodo) {
        $this->periodo = $periodo;
    }

    function setValorHora($valorHora) {
        $this->valorHora = $valorHora;
    }

    function getCustoHora() {
        return $this->valorTotal;
    }
}