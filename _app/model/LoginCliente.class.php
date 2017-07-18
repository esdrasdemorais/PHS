<?php
/**
 * Description of LoginCliente
 *
 * @author esdrassilva
 */
class LoginCliente extends Login
{
    private $clienteId;
    private $tipo = LoginTipo::CLIENTE;
    
    public function getTipo()
    {
        return $this->tipo;
    }
    
    public function getCliente()
    {
        return $this->clienteId;
    }
    
    public function setCliente(Cliente $cliente)
    {
        $this->clienteId = $cliente->getId();
    }
}