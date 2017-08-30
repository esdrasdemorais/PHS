<?php
/**
 *@author: Esdras de Morais da Silva
 */
class AvaliacaoController extends Controller
{
    public function __construct()
    {
        parent::__construct();
	    if (false === SessionManagement::persist('cliente')) {
	        $this->redirect($this->getBaseUrl() . '/index.php/login');
	    }
        $this->servicoAvaliacaoDAO = new ServicoAvaliacaoDAO();
    }

    public function indexAction()
    {
        $servicoAgendamentoId = $this->getParams()['agendamento'];
        $servicoAgendamentoDAO = new ServicoAgendamentoDAO();
        $servicoAgendamento = $servicoAgendamentoDAO->listar(
            $servicoAgendamentoId)[0];
        $arrDados = ['servico_agendamento_id'=>$servicoAgendamento->getId(),
            'url'=>$this->getBaseUrl()];
        View::render('view/avaliacao/index', $arrDados);
    }

    public function salvarAction()
    {
        try {
            $servicoAvaliacao = $this->servicoAvaliacaoDAO
                ->setServicoAvaliacao($this->getRequest());
            $servicoAvaliacao = $this->servicoAvaliacaoDAO->salvar(
                $servicoAvaliacao);
            if ($servicoAvaliacao instanceof ServicoAvaliacao) {
                $msg = 'Obrigado por sua Avaliação, ela é muito Importante.';
                $arrDados = array('titulo'=>'Avaliação Enviada', 'msg'=> $msg,
                    'url'=>$this->getBaseUrl());
            }
            View::render('view/avaliacao/sucesso', $arrDados);
        } catch (Exception $e) {
            SSErro("Ops! Infelizmente ouve um problema!", SS_ERROR);
        } 
    }
}
