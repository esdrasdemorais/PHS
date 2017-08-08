<?php
/**
 * Description of Descricao
 *
 * @author esdrassilva
 */
class Servico
{
    private $id;
    private $nome;
    private $status = 1;
    private $icon;
    protected $valorHora;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getIcon() {
        return $this->icon;
    }
    
    function getValorHora() {
        return $this->valorHora;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function setIcon($icon) {
        $this->icon = $icon;
    }
    
    function setValorHora($valorHora) {
        $this->valorHora = $valorHora;
    }
}