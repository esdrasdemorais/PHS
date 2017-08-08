<?php

/**
 * Servico.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class ServicoAgendamento
{
    protected $id;
    protected $data;
    protected $hora;
    protected $periodo;
    protected $valorTotal;
    protected $endereco;
    protected $cliente;
    protected $emailEnviado;
    protected $servico;
    
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

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setCliente(Cliente $cliente) {
        $this->cliente = $cliente;
    }
    
    private function setCustoHora() {
        $servico = $this->getServico();
        $this->valorTotal = $this->periodo * $servico->getValorHora();
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
    
    public function getServico() {
        return $this->servico;
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

    function getCustoHora() {
        return $this->valorTotal;
    }
    
    function getEmailEnviado() {
        return $this->emailEnviado;
    }

    function setEmailEnviado($emailEnviado) {
        $this->emailEnviado = $emailEnviado;
    }
    
    public function setServico(Servico $servico) {
        $this->servico = $servico;
    }
}