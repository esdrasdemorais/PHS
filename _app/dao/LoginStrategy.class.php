<?php
/**
 * Description of LoginStrategy
 *
 * @author esdrassilva
 */
interface LoginStrategy
{
    public function autenticar(Login $login);
    public function deslogar(Login $login);
}