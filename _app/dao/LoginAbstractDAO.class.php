<?php
/**
 * Description of LoginAbstract
 *
 * @author esdrassilva
 */
abstract class LoginAbstractDAO
{
    protected function isLoged($login)
    {
        $read = new Read();
        $read->ExeRead('login', "where login=:login and tipo=:tipo " .
            "and logado='1'", 'login=' . $login->getLogin() . '&tipo=' . 
            $login->getTipo());
        return true === count($read->getResult()) > 0;
    }
    
    protected function saveLogado($login)
    {
        $login->setLogado('1');
        $login->setDataUltimoAcesso(date('Y-m-d H:i:s'));
        $update = new Update();
        $arrLogin = array(
            "logado"=>$login->getLogado(), "data_ultimo_acesso"=>
            $login->getDataUltimoAcesso()
        );
        $update->ExeUpdate('login', $arrLogin, 'where id=:id', 'id=' . 
            $login->getId());
    }
    
    public function checkEmail($email)
    {
        $clienteDAO = new ClienteDAO();       
        return $clienteDAO->searchByEmail($email);
    }
    
    public function atualizar($login)
    {
        $update = new Update();
        $arrLogin = array(
            //"login"=>$login->getLogin(), "senha"=>sha1($login->getSenha()),
            "logado"=>$login->getLogado(),
            "data_ultimo_acesso"=>$login->getDataUltimoAcesso(),
            "cookie_hash"=>$login->getCookieHash());
        try {
            $update->ExeUpdate("login", $arrLogin, 'where id=:id',
                'id='.$login->getId());
            return $login;
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());
       }
    }
    
    public function salvar($login)
    {
        $create = new Create();
        $arrLogin = array(
            "cliente_id"=>$login->getCliente(), "tipo"=>$login->getTipo(), 
            "login"=>$login->getLogin(), "senha"=>sha1($login->getSenha()),
            "logado"=>"0"
        );
        try {
            $create->ExeCreate('login', $arrLogin);
            if (is_numeric($create->getResult())) {
                $login->setId($create->getResult());
                return $login;
            }
        } catch (Exception $ex) {
            throw new Exception('Não foi possível salvar seu login.');
        }
    }

    public function searchByCookie(Cookie $cookie)
    {
	$read = new Read();
	$cookieHash = $cookie->get(Cookie::$cookieName);
        $read->ExeRead('login', 'where cookie_hash=:cookie', 'cookie=' . 
            $cookieHash);
        
        return $read->getResult();
    }
}