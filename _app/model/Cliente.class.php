<?php

//namespace _app\Model;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cliente
 *
 * @author victorcaetano
 */
class Cliente {
    private $id;
    private $nome;
    private $email;
    private $cpf;
    private $endereco_id;
    private $telefone;
    
    function getId() {
        return $this->id;
    }
    
    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getEndereco() {
        return $this->endereco_id;
    }

    function getTelefone() {
        return $this->telefone;
    }
  
    function setId($id) {
        $this->id = $id;
    }
    
    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setEndereco(Endereco $endereco) {
        $this->endereco_id = $endereco->getId();
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
}
