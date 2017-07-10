<?php

//namespace _app\Controller;
//
//use _app\Controller as Controller;
//use _app\Model\Cliente as Cliente;
//use _app\DAO\ClienteDAO as ClienteDAO;
//use _app\Helpers\View as View;

class ClienteController extends Controller
{
    protected $cliente;
    protected $clienteDAO;

    public function indexAction()
    {
        die('inicio da controller salvar');
        //$this->listarAction();
        //@TODO Login
        View::Load('view/cliente/salvar');
        View::Show(array());
    }

    public function salvarAction()
    {
        var_dump($post)
        $this->clienteDAO = new ClienteDAO();
        $this->clienteDAO->salvar($this->cliente);
    }

    public function alterarAction()
    {
        $this->clienteDAO = new ClienteDAO();
        $this->clienteDAO->alterar($this->Cliente);
    }

    public function deletarAction()
    {
        $this->clienteDAO = new ClienteDAO();
        $this->clienteDAO->deletar($this->Cliente);
    }

    public function listarAction()
    {
        $this->clienteDAO = new ClienteDAO();
        $this->clienteDAO->listar();
    }
}