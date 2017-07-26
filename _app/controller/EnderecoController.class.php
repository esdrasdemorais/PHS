<?php
/**
 * Description of EnderecoController
 *
 * @author esdrassilva
 */
class EnderecoController extends Controller
{
    private $endereco;
    private $enderecoDAO;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->enderecoDAO = new EnderecoDAO();
        $this->endereco = new Endereco();
    }
    
    public function buscarAction()
    {
        $this->enderecoDAO->setMapsApiEndereco($this->endereco, 
            $this->getParams());
        $endereco = $this->enderecoDAO->searchByEndereco($this->endereco);
        echo "{\"results\" : " . json_encode($endereco) . "}";
        exit;
    }
}
