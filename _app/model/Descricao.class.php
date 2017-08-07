<?php
/**
 * Description of Descricao
 *
 * @author esdrassilva
 */
class Descricao
{
    private $id;
    private $nome;
    private $status = 1;
    
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getStatus() {
        return $this->status;
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
}
