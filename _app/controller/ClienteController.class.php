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
        View::Load('view/cliente/salvar');
        View::render('view/cliente/salvar');
    }

    public function criarAction()
    {
        if (is_numeric($this->getParams('id'))) {
            $this->clienteDAO = new ClienteDAO();
            $this->cliente = $this->clienteDAO->listar($this->getParams('id'))[0];
        }
        View::render('view/cliente/salvar', (array)$this->cliente);
    }

    public function salvarAction()
    {
        $this->clienteDAO = new ClienteDAO();
        $this->cliente = $this->clienteDAO->setCliente($this->getRequest());
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