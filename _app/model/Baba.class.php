<?php

/**
 * Babysitter.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class Baba extends Servico
{
    private $tipo = ServicoTipo::Baba;
    
    public function getTipo()
    {
        return $this->tipotipo;
    }
}
