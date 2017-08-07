<?php

/**
 * Diarista.class [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class Diarista extends ServicoAgendamento
{
    private $tipo = ServicoTipo::Diarista;
    
    public function getTipo()
    {
        return $this->tipo;
    }
}
