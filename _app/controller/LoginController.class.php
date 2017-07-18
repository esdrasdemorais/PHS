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
        $login = $this->loginDAO->autenticar($this->loginModel);
        if ($login instanceof $loginModelName) {
            //Session::create($login);
        } else {
            $login = $this->getRequest()['login'];
            
            View::render('view/login/login', array('tipo'=>$this->tipo,'login'=>
                $login,'senha'=>'','url'=>$this->getBaseUrl(),'id'=>'','msg'=>
                'Usuario ou senha não existe.')); 
        }
    }
    
    public function recuperarAction()
    {
        View::render('view/login/recuperar', array('tipo'=>$this->tipo,'login'=>
            '','senha'=>'','url'=>$this->getBaseUrl(),'id'=>'','msg'=>'')); 
    }
    
    public function sairAction()
    {
        $this->loginDAO->deslogar(Session::getLogin());
        //Session::clear();
    }
}