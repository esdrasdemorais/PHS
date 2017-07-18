<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginCliente
 *
 * @author esdrassilva
 */
class LoginCliente extends Login
{
    private $tipo = LoginTipo::PROFISSIONAL;
    
    public function getTipo()
    {
        return $this->tipo;
    }    
}
