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
    protected $endereco;
    protected $emailEnviado;
    protected $qtdDiarias;
    protected $valorTotal;
    protected $servicoCliente;
    
    function getId() {
        return $this->id;
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

    function getEndereco() {
        return $this->endereco;
    }
    
    function getEmailEnviado() {
        return $this->emailEnviado;
    }

    public function getQtdDiarias() {
        return $this->qtdDiarias;
    } 

    function getValorTotal() {
        $periodo = $this->qtdDiarias > 0 ? $this->qtdDiarias : $this->periodo;
	    $this->valorTotal = 23.33 * $periodo;
        return $this->valorTotal;
    }

    public function getServicoCliente()
    {
	return $this->servicoCliente;
    }
    
    function setId($id) {
        $this->id = $id;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
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

    function setEmailEnviado($emailEnviado) {
        $this->emailEnviado = $emailEnviado;
    }
    
    public function setQtdDiarias($qtdDiarias) {
        $this->qtdDiarias = $qtdDiarias;
    }

    private function setValorTotal()
    {
        #$servico = $this->getServico();
	    #$this->valorTotal = $this->periodo * $servico->getValorHora();
    }

    public function setServicoCliente($servicoCliente)
    {
	    $this->servicoCliente = $servicoCliente->getId();
    }
}
