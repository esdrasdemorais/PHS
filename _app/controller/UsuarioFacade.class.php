<?php
/**
 * Description of UsuarioFacade
 *
 * @author esdrassilva
 */
class UsuarioFacade
{
    protected $loginDAO;
    protected $session;
    protected $cookie;
    
    public function __construct($tipo)
    {
        $loginDAOName = 'Login' . ucfirst($tipo);
        $this->loginDAO = new $loginDAOName();
        
        $this->session = new Session();//@todo Facade or Factory
        $this->cookie = new Cookie();//@todo What Pattern?
    }
    
    public function inicializar($login)
    {
        $login = $this->loginDAO->autenticar($login);
        $this->session->criar($login);
        $this->cookie->criar($login);
        
        return $login;
    }
}