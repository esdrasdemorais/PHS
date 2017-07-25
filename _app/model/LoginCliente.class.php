<?php
/**
 * Description of LoginCliente
 *
 * @author esdrassilva
 */
class LoginCliente extends Login
{
    private $cliente_id;
    private $tipo = LoginTipo::CLIENTE;
    
    public function getTipo()
    {
        return $this->tipo;
    }
    
    public function getCliente()
    {
        return $this->cliente_id;
    }
    
    public function setCliente(Cliente $cliente)
    {
        $this->cliente_id = $cliente->getId();
    }
}