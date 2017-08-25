<?php
/**
 * Description of ServicoCliente
 *
 * @author esdrassilva
 */
class ServicoCliente
{
    private $id;
    private $servico;
    private $cliente;
    private $data;
    
    public function getId() {
        return $this->id;
    }

    public function getServico() {
        return $this->servico;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getData() {
	return $this->data;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setServico($servicoId) {
        $this->servico = $servicoId;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente->getId();
    }

    public function setData($data) {
	$this->data = $data;
    }
}
