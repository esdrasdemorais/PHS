<?php
/**
 * Description of ServicoController
 *
 * @author esdrassilva
 */
class ServicoController extends Controller
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
        $arrDados = array('url'=>$this->getBaseUrl(),'nome'=>'','icon'=>'',
            'valorTotal'=>'');
        View::render('view/servico/criar', $arrDados);
    }
    
    public function criarAction()
    {
        $arrDados = array('url'=>$this->getBaseUrl(),'nome'=>'','icon'=>'',
            'valorTotal'=>'');
        View::render('view/servico/criar', $arrDados);
    }
}