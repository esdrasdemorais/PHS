<?php

/**
 * Cuidador.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class Cuidador extends ServicoAgendamento
{   
    private $tipo = ServicoTipo::Cuidador;
    
    public function getTipo()
    {
        return $this->tipo;
    }
}
