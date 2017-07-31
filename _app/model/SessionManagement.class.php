<?php
/**
 * Description of Session Abstract Factory / Factory Method
 *
 * @author esdrassilva
 */
class SessionManagement
{
    protected $session;

    public function __construct(Session $session, $tipo)
    {
	$this->session = $session;
	$this->tipo = $tipo;
    }
    
    public function getSession()
    {
	return $this->session;
    }

    public function createSessionFromCookie(Cookie $cookie)
    {
	$loginDAOName = 'Login' . ucfirst($this->tipo) . 'DAO';
	$loginDAO = new $loginDAOName();
	$arrLogin = $loginDAO->searchByCookie($cookie);
        $login = $loginDAO->setLogin($arrLogin[0]);
	$this->session->criar($login);
    }

    public static function persist($tipo)
    {
        //session_start();
	if (true === Session::checkSession()) {
            return true;
        }
        if (true === Cookie::isCreated()) {
            $loginName = 'Login' . ucfirst($tipo);
            $login = new $loginName();
	    $sessionManagement = new SessionManagement(new Session($tipo, $login), $tipo);
	    $sessionManagement->createSessionFromCookie(new Cookie($tipo));
            return true;
	}
	return false;
    }
}
