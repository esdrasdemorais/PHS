<?php

/**
 * ServicoTipo [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class LoginTipo extends SplEnum
{
    const __default = self::Cliente;
    
    const CLIENTE       = 1;
    const ADMINISTRADOR = 2;
    const PROFISSIONAL  = 3;
}
