<?php
/**
 * Description of Login
 *
 * @author esdrassilva
 */
abstract class Login
{
    private $login;
    private $senha;
    private $ativo;
    private $dataUltimoAcesso;
    private $logado;
    
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
        return $this->dataUltimoAcesso;
    }

    public function getLogado() {
        return $this->logado;
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

    public function setDataUltimoAcesso($dataUltimoAcesso) {
        $this->dataUltimoAcesso = $dataUltimoAcesso;
    }

    public function setLogado($logado) {
        $this->logado = $logado;
    }
}