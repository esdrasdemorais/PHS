<?php
/**
 * Description of Contrato
 *
 * @author esdrassilva
 */
class Contrato
{
    private $id;
    private $numero;
    private $data;
    protected $qtdDiarias;
    protected $valor;
    private $status = 1;
    
    public function getId() {
        return $this->id;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getData() {
        return $this->data;
    }

    public function getQtdDiarias() {
        return $this->qtdDiarias;
    }

    public function getValor() {
        return $this->valor;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function setQtdDiarias($qtdDiarias) {
        $this->qtdDiarias = $qtdDiarias;
    }

    public function setValor($valor) {
        $this->valor = (float) str_replace(",", ".", $valor);
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
