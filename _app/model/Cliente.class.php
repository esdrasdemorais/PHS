<?php

namespace _app\Model;

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
    private $endereco;
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

    function getEndereco() {
        return $this->endereco;
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

    function setEndereco(Endereco $endereco) {
        $this->endereco = $endereco;
    }

    function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
}
