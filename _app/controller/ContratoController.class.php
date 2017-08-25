<?php
/**
 * Description of ContratoController
 *
 * @author esdrassilva
 */
class ContratoController extends Controller
{
    private $contrato;
    private $contratoDAO;
    
    public function __construct()
    {
        parent::__construct();
	if (false === SessionManagement::persist('administrador')) {
	    $this->redirect($this->getBaseUrl() . '/index.php/login');
	}
    }
    
    public function indexAction()
    {
        $arrDados = array('url'=>$this->getBaseUrl(),'numero'=>'','qtdDiarias'=>
            '','valor'=>'','data'=>'','id'=>'');
        View::render('view/contrato/criar', $arrDados);
    }
    
    public function criarAction()
    {
	$this->indexAction();
    }
    
    public function salvarAction()
    {
        $this->contratoDAO = new ContratoDAO();
        $this->contrato = $this->contratoDAO->setContrato($this->getRequest());
        $contrato = $this->contratoDAO->salvar($this->contrato);
        if ($contrato->getId() > 0) {
            $arrCliente = array('id'=>$contrato->getId(), 'titulo'=>'Contrato',
                'msg'=>'Contrato Salvo com Sucesso.','url'=>$this->getBaseUrl());
            View::render('view/contrato/sucesso', $arrCliente);
        }
    }
}
