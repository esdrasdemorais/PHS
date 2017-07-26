<?php
/**
 * Description of Session Abstract Factory / Factory Method
 *
 * @author esdrassilva
 */
class Session extends Object implements SessionHandlerInterface
{
    protected $loginDAO;
    private   $loginModel;
    private   $sessionHandler;
    
    public function __construct($login, $tipo)
    {
        $loginDAOName = 'Login' . ucfirst($tipo) . 'DAO';
	$this->loginDAO = new $loginDAOName();
	$this->loginModel = $login;

        $this->sessionHandler = new SessionHandler();
	$this->salvar();
    }
    
    public function close(): bool
    {
        return $this->sessionHandler->close();
    }

    public function destroy($session_id): bool
    {
        return $this->sessionHandler->destroy($session_id);
    }
 
    public function gc($maxlifetime): bool
    {
        return $this->sessionHandler->gc($maxlifetime);
    }

    public function open($save_path, $session_name): bool
    {
        return $this->sessionHandler->open($save_path, $session_name);
    }

    public function read($session_id): string
    {
        return $this->sessionHandler->read($session_id);
    }

    public function write($session_id, $session_data): bool
    {
        return $this->sessionHandler->write($session_id, $session_data);
    }

    private function salvar()
    {
	ini_set('session.save_handler', 'files');
    	if (true === session_set_save_handler($this->sessionHandler, true)) {
	    session_start();
    	    $this->loginModel->setDataUltimoAcesso(date('Y-m-d H:i:s'));
            $this->loginModel->setLogado('1');
	    $this->loginDAO->atualizar($this->loginModel);
	}
    }

    public function criar($login)
    {
        $arrLogin = array(
            "login"=>$login->getLogin(),
        );
	foreach($arrLogin as $chave => $valor) {
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