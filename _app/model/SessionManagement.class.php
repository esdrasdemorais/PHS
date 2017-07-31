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
	$login = $loginDAO->searchByCookie($cookie)[0];
	$this->session->criar($login);
    }

    public static function persist($tipo)
    {
	if (true === Session::checkSession()
            || true === Cookie::isCreated())
        {
	    $sessionManagement = new SessionManagement(new Session(), $tipo);
	    $sessionManagement->createSessionFromCookie(new Cookie());
	}
	return false;
    }
}
