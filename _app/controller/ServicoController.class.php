<?php

class ServicoController extends Controller
{
    protected $servico;
    protected $Baba;
    protected $Cuidador;
    protected $Diarista;
    protected $BabaDAO;
    protected $CuidadorDAO;
    protected $DiaristaDAO;

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
        $arrDados = array('url'=>$this->getBaseUrl(),'id'=>'','data'=>'','hora'=>'','periodo'=>'','endereco'=>'','tipo'=>$tipo);
        View::render('view/servico/definir', $arrDados);
    }
    
    public function salvarAction()
    {        
        $tipo = $this->getParams()['tipo'];
        switch ($tipo){
            case 'baba': 
                $this->salvarBaba();
                break;
            case 'diarista':
                $this->salvarDiarista();
                break;
            case 'cuidador':
                $this->salvarCuidador();
                break;
        }
    }
    
    private function salvarBaba(){
        try{
            $this->BabaDAO = new BabaDAO();   
            $this->Baba = $this->BabaDAO->setServico($this->getRequest());
            var_dump($this->Baba);
            $this->BabaDAO->salvar($this->Baba);            
            if(true === $this->enviarEmail($this->Baba)){
                $this->Baba->setEmailEnviado('S');
                $this->BabaDAO->alterar($this->Baba);
            }
            $this->enviarSucesso();
        } catch (Exception $e) {
            SSErro("Ops! Infelizmente ouve um problema. Tente novamente!", SS_ERROR);                                   
        }    
    }   
    
    private function salvarCuidador(){
        try{
            $this->CuidadorDAO = new CuidadorDAO();   
            $this->Cuidador = $this->CuidadorDAO->setServico($this->getRequest());
            $this->CuidadorDAO->salvar($this->Cuidador);            
            if(true === $this->enviarEmail($this->Cuidador)){
                $this->Cuidador->setEmailEnviado('S');
                $this->CuidadorDAO->alterar($this->Cuidador);
            }
            $this->enviarSucesso();
        } catch (Exception $e) {
            SSErro("Ops! Infelizmente ouve um problema. Tente novamente!", SS_ERROR);                                   
        }    
    }  
    
    private function salvarDiarista(){
        try{
            $this->DiaristaDAO = new DiaristaDAO();   
            $this->Diarista = $this->DiaristaDAO->setServico($this->getRequest());
            $this->DiaristaDAO->salvar($this->Diarista);            
            if(true === $this->enviarEmail($this->Diarista)){
                $this->Diarista->setEmailEnviado('S');
                $this->DiaristaDAO->alterar($this->Diarista);
            }
            $this->enviarSucesso();
        } catch (Exception $e) {
            SSErro("Ops! Infelizmente ouve um problema. Tente novamente!", SS_ERROR);                                   
        }    
    }  

    
    private function enviarEmail($arSender,$arReciver,$servico) 
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
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');$mail->addBCC('bcc@example.com');
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Terceiro Elemento - Solicitação de Serviço de' . ucfirst($servico->getTipo()) ;
        $mail->Body    = 'Foi solicitado o serviço de '. ucfirst($servico->getTipo()) . ', para cliente abaixo:'
                         .'<br> Nome: ' . $servico->getCliente()->getNome()
                         .'<br> Endereço: ' . $servico->getEndereco()->getLogradouro() . ', '
                         . $servico->getEndereco()->getNumero() . ', '. $servico->getEndereco()->getComplemento()
                         . ', '. $servico->getEndereco()->getBairro()
                         . ', ' . $servico->getEndereco()->getCidade() . '-' . $servico->getEndereco()->getEstado()
                         .'<br> Data do Agendamento: ' . $servico->getData()
                         .'<br> Horário: ' .  $servico->getHora()
                         .'<br> Periodo: ' . $servico->getPeriodo();
        if (false === $mail->send()) {           
            return true;
        }    
        return false;
    }
    
    private function enviarSucesso(){
        $mensagem = 'Sua solicitação de ' . $this->getParams()['tipo'] . 'está concluída.'
                . '<br> Aguarde contato para confirmação!';
        $arrDados = array('titulo'=>'SUCESSO!!!', 'servicos'=> $mensagem);
    }
    
}