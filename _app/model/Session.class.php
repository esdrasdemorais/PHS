<?php
/**
 * Description of Session Abstract Factory or Factory Method
 *
 * @author esdrassilva
 */
class Session extends SessionHandler, Object
{
    protected $loginDAO;
    private   $loginModel;
    
    public function __construct($login, $tipo)
    {
        $loginDAOName = 'Login' . ucfirst($tipo) . 'DAO';
	$this->loginDAO = new $loginDAOName();
	$this->loginModel = $login;

	$this->salvar();
    }

    private function salvar()
    {
	ini_set('session.save_handler', 'files');
    	if (true === session_set_save_handler($this, true)) {
	    session_start();
    	    $this->loginModel->setDataUltimoAcesso(date('Y-m-d H:i:s'));
	    $this->loginDAO->atualizar($this->loginModel);
	}
	$this->close();
    }

    public function criar($login)
    {
	foreach($login as $chave => $valor) {
	    $this->set($chave, $valor);
	}
	return count($_SESSION) > 0;
    }

    public function set($chave, $valor)
    {
	$_SESSION[$chave] = $valor;
    }

    public function get($chave)
    {
	return $_SESSION[$chave];
    }
}
