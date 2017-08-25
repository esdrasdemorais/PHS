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
        $arrDados = array('url'=>$this->getBaseUrl(), 'id'=>'','data'=>'',
	    'hora'=>'','periodo'=>'','endereco'=>'','servico_cliente_id'=>
	    $servicoClienteId,'minDate'=>date('d') + 1 . date('/m/Y'));
        View::render('view/servico/definir', $arrDados);
    }

    public function salvarAction()
    {
        try {
	    $servicoClienteId = $this->getRequest()['servico_cliente_id'];
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
            View::render('view/servico/sucesso', $arrDados);
        } catch (Exception $e) {
            SSErro("Ops! Infelizmente ouve um problema. Tente novamente!", 
                SS_ERROR);                                   
        } 
    }

    private function enviarEmail($servicoAgendamento) 
    {
	require_once __DIR__ . '/../vendor/PHPMailer/PHPMailerAutoload.php';

	$servicoClienteDAO = new ServicoClienteDAO();
	$servicoCliente = $servicoClienteDAO->listar(
	    $servicoAgendamento->getServicoCliente())[0];
	$clienteDAO = new ClienteDAO();
	$cliente = $clienteDAO->listar($servicoCliente->getCliente())[0];
	$servicoDAO = new ServicoDAO();
	$servico = $servicoDAO->listar($servicoCliente->getServico());

        $mail = new PHPMailer();$mail->SMTPDebug = 3;$mail->setLanguage('pt_br', '/optional/path/to/language/directory/');
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'user@example.com';                 // SMTP username
        $mail->Password = 'secret';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to
        $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
        $mail->addReplyTo($cliente->getEmail(), 'Information');
        //$mail->addCC('cc@example.com');$mail->addBCC('bcc@example.com');
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Terceiro Elemento - Solicitação de Serviço de' . ucfirst($servico->getNome()) ;
        $mail->Body    = 'Foi solicitado o serviço de '. ucfirst($servico->getNome()) . ', para cliente abaixo:'
            .'<br> Nome: ' . $cliente->getNome()
            .'<br> Endereço: ' . $servicoAgendamento->getEndereco()->getLogradouro() . ', '
            . $servicoAgendamento->getEndereco()->getNumero() . ', '//. $servico->getEndereco()->getComplemento()
            . ', '. $servicoAgendamento->getEndereco()->getBairro()
            . ', ' . $servicoAgendamento->getEndereco()->getCidade() . '-' 
            . $servico->getEndereco()->getEstado()
            .'<br> Data do Agendamento: ' . $servicoAgendamento->getData()
            .'<br> Horário: ' .  $servicoAgendamento->getHora()
            .'<br> Periodo: ' . $servicoAgendamento->getPeriodo();
        if (true === $mail->send()) {           
            return true;
        }    
        return false;
    }
}
