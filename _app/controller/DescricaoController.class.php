<?php
/**
 * Description of DescricaoController
 *
 * @author esdrassilva
 */
class DescricaoController extends Controller
{
    private $descricao;
    private $descricaoDAO;
    
    public function __construct()
    {
        parent::__construct();
	if (false === SessionManagement::persist('administrador')) {
	    $this->redirect($this->getBaseUrl() . '/index.php/login');
	}
    }
    
    public function indexAction()
    {
        $arrDados = array('url'=>$this->getBaseUrl(),'nome'=>'','id'=>'');
        View::render('view/descricao/criar', $arrDados);
    }
    
    public function criarAction()
    {
	$this->indexAction();
    }
    
    public function salvarAction()
    {
        $this->descricaoDAO = new DescricaoDAO();
        $this->descricao = $this->descricaoDAO->setDescricao($this->getRequest());
        $descricao = $this->descricaoDAO->salvar($this->descricao);
        if ($descricao->getId() > 0) {
            $arrCliente = array('id'=>$descricao->getId(), 'titulo'=>'Descrição',
                'msg'=>'Descrição Salva com Sucesso.','url'=>$this->getBaseUrl());
            View::render('view/descricao/sucesso', $arrCliente);
        }
    }
}
