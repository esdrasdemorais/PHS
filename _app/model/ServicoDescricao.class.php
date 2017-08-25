<?php
/**
 * Description of ServicoDescricao
 *
 * @author esdrassilva
 */
class ServicoDescricao
{
    private $id;
    private $servicoCliente;
    private $descricao;
    
    public function getId() {
        return $this->id;
    }

    public function getServicoCliente() {
        return $this->servicoCliente;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setServicoCliente($servicoCliente) {
        $this->servicoCliente = $servicoCliente->getId();
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao->getId();
    }
}
