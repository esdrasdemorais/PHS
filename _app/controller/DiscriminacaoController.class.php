<?php
/**
 * Description of DiscriminacaoController
 *
 * @author esdrassilva
 */
class DiscriminacaoController extends Controller
{
    protected $discriminacaoDAO;
    protected $discriminacao;

    public function __construct()
    {
        parent::__construct();
	if (false === SessionManagement::persist('cliente')) {
	    $this->redirect($this->getBaseUrl() . '/index.php/login');
	}
	$this->discriminacaoDAO = new ServicoDescricaoDAO();
    }

    private function salvarServicoCliente()
    {
	$servicoClienteDAO = new ServicoClienteDAO();
	$servicoCliente = $servicoClienteDAO->setServicoCliente(['cliente'=>
	    Session::get('cliente_id'),'servico'=>$this->getParams()['tipo'],
	    'id'=>'']);
	$servicoCliente = $servicoClienteDAO->salvar($servicoCliente);
	return $servicoCliente;
    }

    public function indexAction()
    {
	$servicoCliente = $this->salvarServicoCliente();
	$discriminacoes = $this->getDiscriminacoes();
	$arrDados = array('url'=>$this->getBaseUrl(),'observacao'=>'','msg'=>''
	    ,'tipo'=>$this->getParams()['tipo'],'discriminacoes'=>
	    $discriminacoes,'servico_cliente_id'=>$servicoCliente->getId());
        View::render('view/servico/discriminacao', $arrDados);
    }
    
    public function discriminarAction()
    {
	$this->indexAction();
    }

    private function getDiscriminacoes()
    {
	$discriminacoes = array();
	$descricaoDAO = new DescricaoDAO();
	$arrDiscriminacoes = $descricaoDAO->listar();
    	return $arrDiscriminacoes;
    }

    public function salvarAction()
    {
        try {
	    $this->discriminacao = $this->discriminacaoDAO
		->setServicosDescricao($this->getRequest());
	    $discriminacao = $this->discriminacaoDAO->salvar(
		$this->discriminacao);
            if (true === ($discriminacao[0] instanceof ServicoDescricao)) {
		$this->redirect($this->getBaseUrl() . 
	   	    '/index.php/agendamento/escolher/servico_cliente_id/' . 
		    $discriminacao[0]->getServicoCliente());
            }
            $msg = 'Erro ao salvar a discriminação do serviço';
	    $arrDados = array('url'=>$this->getBaseUrl(),'observacao'=>'',
		'msg'=>$msg,'discriminacoes'=>$this->getDiscriminacoes());
	    View::render('view/servico/discriminacao', $arrDados);
        } catch (Exception $e) {
            SSErro("Ops! Infelizmente houve um problema. Tente novamente!", 
                SS_ERROR);
        }
    }
}
