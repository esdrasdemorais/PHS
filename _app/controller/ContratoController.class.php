<?php
/**
 * Description of ContratoController
 *
 * @author esdrassilva
 */
class ContratoController extends Controller
{
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
            '','valor'=>'','data'=>'');
        View::render('view/contrato/criar', $arrDados);
    }
    
    public function criarAction()
    {
        $arrDados = array('url'=>$this->getBaseUrl(),'numero'=>'','qtdDiarias'=>
            '','valor'=>'','data'=>'');
        View::render('view/contrato/criar', $arrDados);
    }
}