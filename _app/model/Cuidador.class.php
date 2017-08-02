<?php

/**
 * Cuidador.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class Cuidador extends Servico
{   
    private $tipo = ServicoTipo::Cuidador;
    
    public function getTipo()
    {
        return $this->tipo;
    }
}
