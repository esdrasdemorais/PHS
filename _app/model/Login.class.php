<?php
/**
 * Description of Login
 *
 * @author esdrassilva
 */
abstract class Login
{
    private $id;
    private $login;
    private $senha;
    private $ativo = '1';
    private $data_ultimo_acesso;
    private $logado;
    private $cookie_hash;
    
    public function getId() {
        return $this->id;
    }
    
    public function getLogin()
    {
        return $this->login;
    }

    public function getSenha()
    {
        return $this->senha;
    }
       
    public function getAtivo()
    {
        return $this->ativo;
    }  
   
    public function getDataUltimoAcesso() {
        return $this->data_ultimo_acesso;
    }

    public function getLogado() {
        return $this->logado;
    }
    
    public function getCookieHash() {
        return $this->cookie_hash;
    }

    public function setId($id) {
        $this->id = $id;
    }
    
    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    public function setDataUltimoAcesso($dataUltimoAcesso)
    {
        $this->data_ultimo_acesso = $dataUltimoAcesso;
    }

    public function setLogado($logado)
    {
        $this->logado = $logado;
    }
    
    public function setCookieHash($cookieHash)
    {
        $this->cookie_hash = $cookieHash;
    }
}