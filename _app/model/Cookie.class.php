<?php
class Cookie extends Object
{
    protected $tipo;
    protected $loginModel;
    protected $loginDAO;
    
    public static $cookieName = 'cookusuario';
    
    public function __construct($tipo)
    {
	$this->tipo = $tipo;
        
	//$loginModelName = 'Login' . ucfirst($tipo);
	//$this->loginModel = new $loginModelName();
        
        $loginDAOName = 'Login' . ucfirst($tipo) . 'DAO';
        $this->loginDAO = new $loginDAOName();
    }

    public function criar($login)
    {
        $this->loginModel = $login;
        if (is_object($this->loginModel)) {
            $valor = hash('sha512', $this->loginModel->getLogin());
            $this->set(static::$cookieName, $valor);

            $this->loginModel->setCookieHash($valor);
            $this->loginDAO->atualizar($this->loginModel);
        }
    }

    public function set($chave, $valor)
    {
        setcookie($chave, $valor, time() + 60 * 60 * 24 * 366 * 10, 
            '/', '', true, true);
    }

    public static function get($chave)
    {
        return filter_input(INPUT_COOKIE, $chave);
    }
    
    public static function isCreated()
    {
        return strlen(trim(static::get(static::$cookieName))) > 0;
    }
}
