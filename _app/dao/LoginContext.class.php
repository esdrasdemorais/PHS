<?php
class LoginContext
{
    private $strategy;

    public function __construct($strategy)
    {
	$this->strategy = $strategy;	
    }

    public function autenticarStrategy($login)
    {
	return $this->strategy->autenticar($login);
    }

    public function deslogarStrategy($login)
    {
	return $this->strategy->deslogar($login);
    }
}
