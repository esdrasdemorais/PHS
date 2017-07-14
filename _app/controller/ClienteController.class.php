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
        $arrDados = array('url'=>$this->getBaseUrl(),'id'=>'','nome'=>'','email'=>'','endereco'=>'','telefone'=>'');
        View::Load('view/cliente/salvar');
        View::render('view/cliente/salvar', $arrDados);
    }

    public function criarAction()
    {
        $arrCliente = array('id'=>'','nome'=>'','email'=>'','endereco'=>'','telefone'=>'');
        if (is_numeric($this->getParams('id'))) {
            $this->clienteDAO = new ClienteDAO();
            $this->cliente = $this->clienteDAO->listar($this->getParams('id'))[0];
            $arrCliente = (array) $this->cliente;
        }
        $arrCliente = array_merge($arrCliente, array('url'=>$this->getBaseUrl()));
        View::render('view/cliente/salvar', $arrCliente);
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
    
    public function escolherAction()
    {
        
    }
}