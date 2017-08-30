<?php
/**
 * Description of LoginClienteConcrete
 *
 * @author esdrassilva
 */
class LoginClienteDAO extends LoginAbstractDAO implements LoginStrategy
{
    public function setLogin($arrLogin)
    {
        $login = new LoginCliente();
        $login->setId(isset($arrLogin['id']) ? $arrLogin['id'] : null);
        $login->setLogin($arrLogin['login']);
        $login->setSenha($arrLogin['senha']);
        
        $clienteDAO = new ClienteDAO();
        $cliente = ((int)$arrLogin['id']) > 0 ?
            $clienteDAO->listar($arrLogin['id']) : null;
        if ($cliente instanceof Cliente) {
            $login->setCliente($cliente[0]);
        }

        return $login;
    }
    
    public function autenticar($login)
    {
        $read = new Read();
        if (true === $this->isLoged($login)) {
            return $login;
        }
        $read->ExeRead('login', 'where login=:login and senha=:senha', 
        'login=' . $login->getLogin() . '&senha=' . sha1($login->getSenha()));
        if (true === count($read->getResult()) > 0) {
            $login = $this->setLogin($read->getResult()[0]);
            $this->saveLogado($login);
            return $login;
        }
        return false;
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
