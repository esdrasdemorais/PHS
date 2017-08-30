<?php
/**
 * Description of AgendamentoController
 *
 * @author esdrassilva
 */
class AgendamentoController extends Controller
{
    protected $servico;
    protected $servicoDAO;

    public function __construct()
    {
        parent::__construct();
	    if (false === SessionManagement::persist('cliente')) {
	        $this->redirect($this->getBaseUrl() . '/index.php/login');
	    }
        $this->servicoDAO = new ServicoAgendamentoDAO();
    }
    
    public function indexAction()
    {
        $arrDados = array('url'=>$this->getBaseUrl(), 'servicos'=> array(
	    'baba'=>array('tipo'=>'baba','imagem'=>$this->getBaseUrl().
	    '/images/baba.png','alt'=>'Escolha o serviço de Babá','titulo'=>
	    'Babá'),
	    'diarista'=>array('tipo'=>'diarista','imagem'=>$this->getBaseUrl().
	    '/images/diarista.png','alt'=>'Escolha o serviço de Diarista',
	    'titulo'=>'Diarista'),
	    'cuidador'=>array('tipo'=>'cuidador','imagem'=>$this->getBaseUrl().
	    '/images/cuidador.png','alt'=>'Escolha o serviço de Cuidador',
	    'titulo'=>'Cuidador')));
        View::render('view/servico/escolher', $arrDados);
    }
    
    public function escolherAction()
    {
        $servicoClienteId = $this->getParams()['servico_cliente_id'];
        $clienteDAO = new ClienteDAO();
        $labelPeriodo = 'Período de Horas:';
        $namePeriodo = 'periodo';
        $maxPeriodo = 12;
        if (true === $clienteDAO->hasContrato(Session::get('cliente_id'))) {
            $labelPeriodo = 'Qtd. Diárias:';
            $namePeriodo = 'qtdDiarias';
            $maxPeriodo = 777;
        }
        $arrDados = array('url'=>$this->getBaseUrl(), 'id'=>'','data'=>'',
	        'hora'=>'','valuePeriodo'=>'','endereco'=>'','servico_cliente_id'=>
            $servicoClienteId,'minDate'=>date('d') + 1 . date('/m/Y'),
            'labelPeriodo'=>$labelPeriodo,'namePeriodo'=>$namePeriodo,
            'maxPeriodo'=>$maxPeriodo);
        View::render('view/servico/definir', $arrDados);
    }

    private function updateEmailEnviado()
    {
        $this->servico->setEmailEnviado('S');
        $this->servicoDAO->alterar($this->servico);
    }

    public function salvarAction()
    {
        try {
            $this->servico = $this->servicoDAO->setServicoAgendamento(
                $this->getRequest());
            $this->servico = $this->servicoDAO->salvar($this->servico);
            if (true === $this->enviarEmail($this->servico)) {
                $this->updateEmailEnviado();
            }
            $servicoClienteDAO = new ServicoClienteDAO();
            $servicoCliente = $servicoClienteDAO->listar(
                $this->getRequest()['servico_cliente_id'])[0];
            $servicoDAO = new ServicoDAO();
            $servico = $servicoDAO->listar($servicoCliente->getServico())[0];
            if ($this->servico instanceof ServicoAgendamento) {
                $msg = 'Sua Solicitação de ' . ucfirst($servico->getNome()) .
                    ' está concluída.<br>Aguarde contato para confirmação!';
                $arrDados = array('titulo'=>'SUCESSO!!!', 'msg'=> $msg,'url'=>
                    $this->getBaseUrl(),'id'=>$this->servico->getId());
                View::render('view/servico/sucesso', $arrDados);
            }
        } catch (Exception $e) {
            SSErro("Ops! Infelizmente ouve um problema. Tente novamente!", 
                SS_ERROR);                                   
        } 
    }

    private function enviarEmail($servicoAgendamento)
    {
	    $servicoClienteDAO = new ServicoClienteDAO();
	    $servicoCliente = $servicoClienteDAO->listar(
	        $servicoAgendamento->getServicoCliente())[0];
	    $clienteDAO = new ClienteDAO();
	    $cliente = $clienteDAO->listar($servicoCliente->getCliente())[0];
	    $servicoDAO = new ServicoDAO();
	    $servico = $servicoDAO->listar($servicoCliente->getServico())[0];
	    #$mail = new PHPMailerClient();
 	    #$mail->addReplyTo($cliente->getEmail(), 'Information');
        //$mail->addCC('cc@example.com');$mail->addBCC('bcc@example.com');
	    #$mail->Subject = 'Terceiro Elemento - Solicitação de Serviço de' . 
	    #    ucfirst($servico->getNome()) ;
	    #$this->setBody($mail, ['servicoAgendamento'=>$servicoAgendamento, 
	    #    'servico'=>$servico,'cliente'=>$cliente]);
	    //@todo Debug alter true  
        #return (false === $mail->send()) ? true : false;
        return true;
    }

    private function setBody($mail, array $data)
    {
        /*$servicoComplementoDAO = new ServicoComplementoDAO();
        $servicoComplemento = $servicoComplementoDAO->listar(
            $data['servicoAgendamento']->getServicoCliente())[0];
        $complementoDAO = new ComplementoDAO();
        $complemento = $complementoDAO->listar(
            $servicoComplemento->getComplemento())[0];*/
	    $endereco = $data['servicoAgendamento']->getEndereco();
	    $mail->Body = 'Foi solicitado o serviço de ' .
	    ucfirst($data['servico']->getNome()) . ', para cliente abaixo:' .
	    '<br> Nome: ' . $data['cliente']->getNome().'<br>Endereço: ' .
        $endereco->getLogradouro() . ', ' . $endereco->getNumero() .
	    ', ' . #$complemento->getName() . ', ' .
	    $endereco->getBairro() . ', ' . $endereco->getCidade() . '-' .
	    $endereco->getEstado() . '<br>Data do Agendamento: ' .
	    $data['servicoAgendamento']->getData() . '<br>Horário: ' .
	    $data['servicoAgendamento']->getHora() . '<br>Período: ' .
	    $data['servicoAgendamento']->getPeriodo();
    }
}
