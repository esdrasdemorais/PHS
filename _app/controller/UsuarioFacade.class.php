<?php
/**
 * Description of UsuarioFacade
 *
 * @author esdrassilva
 */
class UsuarioFacade
{
    private   $tipo
    protected $loginDAO;
    protected $session;
    protected $cookie;
    
    public function __construct($tipo)
    {
	$this->tipo = $tipo;

        $loginDAOName = 'Login' . ucfirst($tipo);
        $this->loginDAO = new $loginDAOName();
        
        $this->session = null;
        $this->cookie = new Cookie();
    }
    
    public function inicializar($login)
    {
	$loginContext = new LoginContext($this->loginDAO);
        $login = $loginContext->autenticarStrategy($login);
	
	$this->session = new Session($login, $this->tipo);
	$this->session->criar($login);

        $this->cookie->criar($login);
        
        return $login;
    }
}
