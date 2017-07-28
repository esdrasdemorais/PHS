<?php

class ServicoController extends Controller
{
    protected $servico;
    protected $BabaDAO;
    protected $CuidadorDAO;
    protected $DiaristaDAO;

    public function __construct()
    {
        parent::__construct();
        if (false === Session::checkSession()
            && false === Cookie::isCreated())
        {
            $this->redirect($this->getBaseUrl() . '/index.php/login');
        }
    }
    
    public function indexAction()
    {
        $arrDados = array('url'=>$this->getBaseUrl(), 'servicos'=> array(
            'baba'=>array('tipo'=>'baba','imagem'=>$this->getBaseUrl().'/images/baba.png','alt'=>'Escolha o serviço de Babá','titulo'=>'Babá'),
            'diarista'=>array('tipo'=>'diarista','imagem'=>$this->getBaseUrl().'/images/diarista.png','alt'=>'Escolha o serviço de Diarista','titulo'=>'Diarista'),
            'cuidador'=>array('tipo'=>'cuidador','imagem'=>$this->getBaseUrl().'/images/cuidador.png','alt'=>'Escolha o serviço de Cuidador','titulo'=>'Cuidador')));
        View::render('view/servico/escolher', $arrDados);
    }
    
    public function escolherAction()
    {
        $tipo = $this->getParams()['tipo'];
        $arrDados = array('url'=>$this->getBaseUrl(), 'id'=>'','data'=>'',
            'hora'=>'','periodo'=>'','endereco'=>'','tipo'=>$tipo);
        View::render('view/servico/definir', $arrDados);
    }
    
    public function salvarAction()
    {
        $tipo = $this->getParams()['tipo'];
        switch ($tipo) {
            case 'baba':
                $this->salvarBaba();
                break;
        }
    }
    
    private function salvarBaba()
    {
        try {
            $this->babaDAO = new BabaDAO();        
            $servico = $this->babaDAO->salvar(
                $this->BabaDAO->setServico($this->getParams())
            );
            $this->enviarEmail($servico);
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());                                   
        }
    }
    
    private function enviarEmail($servico) 
    {
        require_once __DIR__ . '/../vendor/PHPMailer/PHPMailerAutoload.php';
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
        $mail->addReplyTo($servico->getCliente()->getEmail(), 'Information');
        //$mail->addCC('cc@example.com');$mail->addBCC('bcc@example.com');
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Terceiro Elemento - Solicitação de Serviço de' . ucfirst($servico->getTipo()) ;
        $mail->Body = 'Foi solicitado o serviço de '. ucfirst($servico->getTipo()) . ', para cliente abaixo:'
            .'<br> Nome: ' . $servico->getCliente()->getNome()
            .'<br> Endereço: ' . $servico->getEndereco()->getLogradouro() . ', '
            . $servico->getEndereco()->getNumero() . ' - '. $servico->getEndereco()->getBairro()
            . ', ' . $servico->getEndereco()->getCidade() . ' - ' . $servico->getEndereco()->getEstado() .
            '<br><hr><br>Detalhe do Serviço:<br>Data do Agendamento: ' . $servico->getData() .
            '';
        if (false === $mail->send()) {
            return 'Não foi possível enviar email. ' . $mail->ErrorInfo;
        }    
        return 'Email enviado!';
    }
}