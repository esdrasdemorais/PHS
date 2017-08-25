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
	$this->criarAction();
    }

    public function criarAction()
    {
        $arrCliente = array('id'=>'','nome'=>'','email'=>'','endereco'=>'',
            'telefone'=>'','cpf'=>'');
        if (is_numeric($this->getParams('id'))) {
            $this->clienteDAO = new ClienteDAO();
            $this->cliente = $this->clienteDAO->listar(
                $this->getParams('id'))[0];
            $object = new Object();
            $arrCliente = $object->toArray($this->cliente);
        }
        $arrCliente = array_merge($arrCliente, 
            array('url'=>$this->getBaseUrl()));
        View::render('view/cliente/salvar', $arrCliente);
    }

    public function salvarAction()
    {
        $this->clienteDAO = new ClienteDAO();
        $this->cliente = $this->clienteDAO->setCliente($this->getRequest());
        $cliente = $this->clienteDAO->salvar($this->cliente);
        if ($cliente->getId() > 0) {
            $arrCliente = array('id'=>$cliente->getId(),'tipo'=>'cliente',
                'email'=>$cliente->getEmail(),'url'=>$this->getBaseUrl(),
                'login'=>'','senha'=>'','msg'=>'');
            View::render('view/login/criar', $arrCliente);
        }
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
    
    public function escolherAction()
    {
        
    }
}
