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
}