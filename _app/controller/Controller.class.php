<?php

#namespace _app\Controller;

#use _app\helpers\View as View;

abstract class Controller
{
    private $url;
    private $baseUrl;
    private $controllerName;
    private $actionName;
    private $params;//@Todo
    private $title;        

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_URI'];//retorna url

        $this->baseUrl = substr($_SERVER['PHP_SELF'], 0, strpos($_SERVER['PHP_SELF'], '/index.php'));//retorna a raiz

        //$baseUrl = começa em PHS e vai até
        $queryString = substr($this->url, strpos($this->url, '/index.php') + strlen('/index.php'));

        $this->params = array_filter(explode('/', $queryString));

        $this->controllerName = ucfirst(array_shift($this->params)) . 'Controller';
        $this->actionName = strtolower(array_shift($this->params)) . 'Action';
    }

    public function getRequest()
    {
        return $_POST;
        //@todo var_dump(filter_input(INPUT_POST, 'var', FILTER_DEFAULT , FILTER_REQUIRE_ARRAY));
    }
    
    public function getParams() 
    {
        $params = array();
        foreach ($this->params as $value) {
            $params[array_shift($this->params)] = array_shift($this->params);
        }
        return array_filter($params);
    }
    
    public function indexAction()
    {
        $this->title = 'Terceiro Elemento';

        View::Load('view/default/index');
        View::Show(array());
    }

    public function redirect($url)
    {
        header('Location: ' . $url);
    }
}
