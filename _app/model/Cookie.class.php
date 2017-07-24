<?php
class Cookie extends Object
{
    protected $tipo;
    protected $loginModel;

    public function __construct($tipo)
    {
	$this->tipo = $tipo;
	$loginModelName = 'Login' . ucfirst($tipo);
	$this->loginModel = new $loginModelName();
    }

    public function criar($login)
    {
	foreach($login as $chave => $valor) {
	    $this->set($chave, $valor);	    
	}
    }

    public function set($chave, $valor)
    {
 	$_COOKIE[$chave] = $valor;
    }

    public funtion get($chave)
    {
	return $_COOKIE[$chave];
    }
}
