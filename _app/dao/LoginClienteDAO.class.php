<?php
/**
 * Description of LoginClienteConcrete
 *
 * @author esdrassilva
 */
class LoginClienteDAO extends Object implements LoginStrategy
{
    public function setLogin(array $arrLogin)
    {
        $login = new LoginCliente();
        $login->setLogin($arrLogin['login']);
        $login->setSenha($arrLogin['senha']);
        
        return $login;
    }
    
    private function isLoged($login)
    {
        $read = new Read();
        $read->ExeRead('login', 'where login = :login and logado = :logado',
            'login=' . $login->getLogin() . '&logado=' . $login->getTipo());
        return true === count($read->getResult()) > 0;
    }
    
    public function autenticar($login)
    {
        if (true === $this->isLoged($login)) {
            return true;
        }  
        $read = new Read();
        $read->ExeRead('login', 'where login = :login and senha = :senha', 
        'login=' . $login->getLogin() . '&senha=' . sha1($login->getSenha()));
        if (true === count($read->getResult()) > 0) {
            $login->setId($read->getResult()['id']);
            $login->setLogado('1');
            $login->setDataUltimoAcesso(date('Y-m-d H:i:s'));
            $update = new Update();
            $update->ExeUpdate('login', $this->toArray($login), 
                'where id=:id', 'id=' . $read->getResult()['id']);
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
}



























































