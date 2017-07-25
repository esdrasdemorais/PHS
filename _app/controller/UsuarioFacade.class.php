<?php
/**
 * Description of UsuarioFacade
 *
 * @author esdrassilva
 */
class UsuarioFacade
{
    private   $tipo;
    protected $loginDAO;
    protected $session;
    protected $cookie;
    
    public function __construct($tipo)
    {
	$this->tipo = $tipo;

        $loginDAOName = 'Login' . ucfirst($tipo) . 'DAO';
        $this->loginDAO = new $loginDAOName();
        
        $this->session = null;
        $this->cookie = new Cookie($tipo);
    }
    
    public function inicializar($log)
    {
	$loginContext = new LoginContext($this->loginDAO);
        $login = $loginContext->autenticarStrategy($log);
	
	$this->session = new Session($log, $this->tipo);
	$this->session->criar($log);

        $this->cookie->criar($log);
        
        return $login;
    }
}
