<?php
/**
 * Description of LoginAdministradorConcrete
 *
 * @author esdrassilva
 */
class LoginAdministradorDAO extends LoginAbstractDAO implements LoginStrategy
{
    public function setLogin($arrLogin)
    {
        $login = new LoginAdministrador();
        $login->setId(isset($arrLogin['id']) ? $arrLogin['id'] : null);
        $login->setLogin($arrLogin['login']);
        $login->setSenha($arrLogin['senha']);
        return $login;
    }
    
    public function autenticar($login)
    {
        $read = new Read();
        if (true === $this->isLoged($login)) {
            return $login;
        }
        $read->ExeRead('login', 'where login=:login and senha=:senha and tipo='
            .':tipo', 'login=' . $login->getLogin() . '&senha=' . 
            sha1($login->getSenha()) . '&tipo=' . $login->getTipo());
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
            'where id=:id and tipo=:tipo', 'id=' . $login->getId() . "&".
            $login->getTipo());
    }
}