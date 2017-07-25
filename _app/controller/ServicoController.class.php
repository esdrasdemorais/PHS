<?php

class ServicoController extends Controller
{
    protected $servico;
    protected $BabaDAO;
    protected $CuidadorDAO;
    protected $DiaristaDAO;

    public function indexAction()
    {
        $arrDados = array('url'=>$this->getBaseUrl(),'id'=>'','nome'=>'','email'=>'','endereco'=>'','telefone'=>'');
        View::Load('view/cliente/salvar');
        View::render('view/cliente/salvar', $arrDados);
    }
}