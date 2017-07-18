<?php
/**
 * Description of LoginStrategy
 *
 * @author esdrassilva
 */
interface LoginStrategy
{
    public function autenticar($login);
    public function deslogar($login);
}