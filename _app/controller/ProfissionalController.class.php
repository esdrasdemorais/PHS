<?php
/**
 * Description of ProfissionalController
 *
 * @author esdrassilva
 */
class ProfissionalController extends Controller
{
    public function __construct()
    {
        parent::__construct();
	    if (false === SessionManagement::persist('administrador')) {
	        $this->redirect($this->getBaseUrl() . 
		    '/index.php/login/index/tipo/administrador');
	    }
    }
    
    public function indexAction()
    {
        $this->criarAction();
    }
    
    public function criarAction()
    {
        $arrDados = array('url'=>$this->getBaseUrl(),'nome'=>'','cpf'=>'',
            'foto'=>'','email'=>'','telefone'=>'','endereco'=>'');
        View::render('view/profissional/criar', $arrDados);
    }

    public function salvarAction()
    {
    	//@todo
    }
}
