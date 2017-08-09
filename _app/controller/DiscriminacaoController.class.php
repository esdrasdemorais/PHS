<?php
/**
 * Description of DiscriminacaoController
 *
 * @author esdrassilva
 */
class DiscriminacaoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
	if (false === SessionManagement::persist('cliente')) {
	    $this->redirect($this->getBaseUrl() . '/index.php/login');
	}
    }
    
    public function indexAction()
    {
        $arrDados = array('url'=>$this->getBaseUrl(),'observacao'=>'');
        View::render('view/servico/discriminacao', $arrDados);
    }
    
    public function salvarAction()
    {
        try {
            $this->servicoDAO = new ServicoAgendamentoDAO();
            $this->servico = $this->servicoDAO->setServicoAgendamento(
                $this->getRequest());
            $servico = $this->servicoDAO->salvar($this->servico);
            if (true === $this->enviarEmail($this->servico)) {
                $this->servico->setEmailEnviado('S');
                $this->servicoDAO->alterar($this->servico);
            }
            $mensagem = 'Sua Solicitação de ' . $this->getParams()['tipo'] . 
            'está concluída.<br> Aguarde contato para confirmação!';
            $arrDados = array('titulo'=>'SUCESSO!!!', 'servicos'=> $mensagem);
            View::render('view/servico/definir', $arrDados);
        } catch (Exception $e) {
            SSErro("Ops! Infelizmente ouve um problema. Tente novamente!", 
                SS_ERROR);                                   
        } 
    }
}