<?php
/**
 * Servico.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class ServicoAvaliacao
{
    protected $id;
    protected $data;
    protected $servicoAgendamento;
    protected $nota;
    protected $comentario;
    
    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    public function getServicoAgendamento()
    {
	    return $this->servicoAgendamento;
    }

    function getNota() {
        return $this->nota;
    }
    
    function getComentario() {
        return $this->comentario;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function setData($data) {
        $this->data = $data;
    }

    function setServicoAgendamento($servicoAgendamento) {
        $this->servicoAgendamento = $servicoAgendamento;
    }

    function setNota($nota) {
        $this->nota = $nota;
    }
    
    public function setComentario($comentario) {
        $this->comentario = $comentario;
    }
}
