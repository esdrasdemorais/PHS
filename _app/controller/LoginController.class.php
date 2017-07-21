<?php
/**
 * Description of LoginController
 *
 * @author esdrassilva
 */
class LoginController extends Controller
{
    private $tipo;
    private $loginDAO;
    private $loginModel;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->tipo = isset($this->getParams()['tipo']) ? 
            $this->getParams()['tipo'] : 'cliente';
        
        $loginDAOName = 'Login' . ucfirst($this->tipo) . 'DAO';
        $this->loginDAO = new $loginDAOName();
    }
    
    public function indexAction()
    {
        View::render('view/login/login', array('tipo'=>$this->tipo,'login'=>'',
            'senha'=>'','url'=>$this->getBaseUrl(),'id'=>'','msg'=>''));
    }
    
    public function logarAction()
    {
        $loginModelName = 'Login' . ucfirst($this->getParams()['tipo']);
        $this->loginModel = new $loginModelName();
        $this->loginModel = $this->loginDAO->setLogin($this->getRequest());

        $usuarioFacade = new UsuarioFacade();
        $login = $usuarioFacade->inicializar($this->loginModel);
        
        if (false === $login instanceof $loginModelName) {
            $login = $this->getRequest()['login'];      
            View::render('view/login/login', array('tipo'=>$this->tipo,'login'=>
                $login,'senha'=>'','url'=>$this->getBaseUrl(),'id'=>'','msg'=>
                'Usuario ou senha não existe.')); 
        }
    }
    
    public function recuperarAction()
    {
        View::render('view/login/recuperar', array('tipo'=>$this->tipo,'email'=>
            '','url'=>$this->getBaseUrl(),'id'=>'','msg'=>'')); 
    }
    
    public function alterarAction()
    {
        View::render('view/login/alterar', array('tipo'=>$this->tipo,'email'=>''
            ,'url'=>$this->getBaseUrl(),'id'=>'','msg'=>''));
    }
    
    public function salvarsenhaAction()
    {
        $loginModelName = 'Login' . ucfirst($this->getParams()['tipo']);
        $this->loginModel = new $loginModelName();
        
        $email = Check::Email($this->getRequest()['email']);
        if (true === $email) {
            $this->loginModel = $this->loginDAO->checkEmail($email);
        } else {
            $msg = 'Email Inválido ou não Cadastrado.';
            View::render('view/login/alterar', array('tipo'=>$this->tipo,
                'email'=>'','url'=>$this->getBaseUrl(),'id'=>'','msg'=>''));
        }
    }
    
    public function enviaremailAction()
    {
        $loginModelName = 'Login' . ucfirst($this->getParams()['tipo']);
        $this->loginModel = new $loginModelName();

        $email = $this->getRequest()['email'];
        if (false === Check::Email($email)) {
            View::render('view/login/recuperar', array('tipo'=>$this->tipo,
                'email'=>$email,'url'=>$this->getBaseUrl(),'id'=>'','msg'=>
                'Email inválido.'));
            return;
        }
        
        $this->loginModel = $this->loginDAO->checkEmail($email);
        if (!($this->loginModel instanceof $loginModelName)) {
            $msg = 'Email não Cadastrado.';
            View::render('view/login/login', array('tipo'=>$this->tipo,'login'=>
                '','senha'=>'','url'=>$this->getBaseUrl(),'id'=>'','msg'=>$msg));
            return;
        }
        
        $this->enviarEmailRecuperacao();        
        View::render('view/login/recuperar', array('tipo'=>$this->tipo,
            'email'=>$email,'url'=>$this->getBaseUrl(),'id'=>'','msg'=>
            'Email enviado com sucesso. Verifique possivelmente seus spams.'));
    }
    
    //@todo REFATORAR
    private function enviarEmailRecuperacao()
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
        $mail->Subject = 'Terceiro Elemento - Recuperação de Senha';
        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        if (false === $mail->send()) {
            return 'Não foi possível enviar email. ' . $mail->ErrorInfo;
        }
        return 'Um email foi enviado com os procedimentos para recuperação.';
    }
    
    public function sairAction()
    {
        //$this->loginDAO->deslogar(Session::getLogin());
        //Session::clear();
    }
}