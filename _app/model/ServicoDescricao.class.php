<?php
/**
 * Description of ServicoDescricao
 *
 * @author esdrassilva
 */
class ServicoDescricao
{
    private $id;
    private $servico;
    private $descricao;
    
    public function getId() {
        return $this->id;
    }

    public function getServico() {
        return $this->servico;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setServico($servico) {
        $this->servico = $servico->getId();
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao->getId();
    }
}