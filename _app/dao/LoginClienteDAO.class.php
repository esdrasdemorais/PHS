<?php
/**
 * Description of LoginClienteConcrete
 *
 * @author esdrassilva
 */
class LoginClienteDAO extends Object implements LoginStrategy
{
    public function setLogin($arrLogin)
    {
        $login = new LoginCliente();
        $login->setLogin($arrLogin['login']);
        $login->setSenha($arrLogin['senha']);
        
        $clienteDAO = new ClienteDAO();
        $cliente = ((int)$arrLogin['id']) > 0 ?
            $clienteDAO->listar($arrLogin['id'])[0] : new Cliente();
        $login->setCliente($cliente);
        
        return $login;
    }
    
    private function isLoged($login)
    {
        $read = new Read();
        $read->ExeRead('login', "where login=:login and tipo=:tipo " .
            "and logado='1'", 'login=' . $login->getLogin() . '&tipo=' . 
            $login->getTipo());
        return true === count($read->getResult()) > 0;
    }
    
    public function autenticar($login)
    {
        if (true === $this->isLoged($login)) {
            return true;
        }
        $read = new Read();
        $read->ExeRead('login', 'where login=:login and senha=:senha', 
        'login=' . $login->getLogin() . '&senha=' . sha1($login->getSenha()));
        if (true === count($read->getResult()) > 0) {
            $login->setId($read->getResult()[0]['id']);
            $login->setLogado('1');
            $login->setDataUltimoAcesso(date('Y-m-d H:i:s'));
            $update = new Update();
            $arrLogin = array(
                "cliente_id"=>$login->getCliente(), "tipo"=>$login->getTipo(), 
                "login"=>$login->getLogin(), "senha"=>sha1($login->getSenha()),
            );
            $update->ExeUpdate('login', $arrLogin, 
                'where id=:id', 'id=' . $read->getResult()[0]['id']);
            return $login;
        }
        return false;
    }

    public function checkEmail($email)
    {
        $clienteDAO = new ClienteDAO();       
        return $clienteDAO->searchByEmail($email);
    }
    
    public function deslogar($login)
    {
        $login->setLogado('0');
        $login->setDataUltimoAcesso(date('Y-m-d H:i:s'));
        
        $update = new Update();
        $update->ExeUpdate('login', $this->toArray($login), 
            'where id=:id', 'id=' . $login->getId());
    }
    
    public function atualizar($login)
    {
        $update = new Update();
        $arrLogin = array(
            "login"=>$login->getLogin(), "senha"=>sha1($login->getSenha()),
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
	$hash = $cookie->get(static::$cookieName);
        $read->ExeRead('login', 'where cookie_hash=:cookie', 'cookie='.$hash);
        
        return $read->getResult();
    }
}
