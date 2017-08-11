<?php

//namespace _app\DAO;
//
//use _app\Model\Cliente as Cliente;

/**
 * ClienteDAO.class.php [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class ClienteDAO extends Object
{
    private $cliente;
    
    public function alterar(Cliente $cliente)
    {
        $update = new Update();

        try {
          $update->ExeUpdate("cliente", $this->toArray($cliente), 'where id=:id',
            'id='.$cliente->getId());
          return $cliente;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }
    
    public function listar($id = null)
    {
        $arrCliente = array();
                
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('cliente', 'where id=:id', 'id=' . $id);
        } else {
            $read->ExeRead('cliente');
        }
        
        foreach($read->getResult() as $cli) {
            $cliente = new Cliente();
            $cliente->setId($cli['id']);
            $cliente->setNome($cli['nome']);
            $cliente->setEmail($cli['email']);
            $endereco = new EnderecoDAO();           
            
            $cliente->setEndereco($endereco->listar($cli['endereco_id'])[0]);       
            
            $arrCliente[] = $cliente;
        }
        
        return $arrCliente;
    }

    public function setCliente($arrCliente)
    {
        $this->cliente = new Cliente();
        $this->cliente->setId($arrCliente['id']);
        $this->cliente->setNome($arrCliente['cli_nome']);
        $this->cliente->setEmail($arrCliente['cli_email']);
        $this->cliente->setTelefone($arrCliente['cli_telefone']);
        
        $this->setEndereco($arrCliente);
        
        return $this->cliente;
    }
    
    public function setMapsApiEndereco($endereco, $arrCliente)
    {
        $arrEndereco = explode(",", $arrCliente['cli_endereco']);        
        $endereco->setLogradouro($arrEndereco[0]);
        
        $arrNumeroBairro = explode("-", $arrEndereco[1]);
        $endereco->setNumero(trim($arrNumeroBairro[0]));
        $endereco->setBairro(trim($arrNumeroBairro[1]));
        
        $arrCidadeEstado = explode("-", $arrEndereco[2]);
        $endereco->setCidade(trim($arrCidadeEstado[0]));
        $endereco->setEstado(trim($arrCidadeEstado[1]));

        $arrEndereco[3] = trim(str_replace("-", "", $arrEndereco[3]));
        $endereco->setCep(is_numeric($arrEndereco[3]) ? $arrEndereco[3] : '');
        
        $endereco->setGeoLocalizacao($arrCliente['geolocalizacao']);
    }
    
    private function setEndereco(array $arrCliente)
    {
        $endereco = new Endereco();
        
        if (is_numeric($arrCliente['endereco_id'])) {
            $enderecoDAO = new EnderecoDAO();
            $endereco = $enderecoDAO->listar($arrCliente['endereco_id']);
            $endereco = $endereco[0];
            
            $this->cliente->setEndereco($endereco);
            return $endereco;
        }
        
        $this->setMapsApiEndereco($endereco, $arrCliente);
        $enderecoDAO = new EnderecoDAO();
        $endereco = $enderecoDAO->salvar($endereco);
        
        $this->cliente->setEndereco($endereco);
    }
    
    public function salvar(Cliente $cliente)
    {
        $create = new Create();
        try {
            $create->ExeCreate('cliente', $this->toArray($cliente));
            if(is_numeric($create->getResult())){
                $cliente->setId($create->getResult());
                return $cliente;
            } else {
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());                                   
        }
    }

    public function deletar(Cliente $cliente)
    {
        $delete = new Delete();

        try {
            $delete->ExeDelete('cliente', 'where id= :id', ':id='.
                $cliente->getId());
            if ($delete->getResult() === true){
              return "Cliente removido com sucesso!";      
            } else {
              throw new Exception("Não foi possível remover o cliente.");
            } 
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }
    
    public function searchByEmail($email)
    {
        $read = new Read();
        $read->ExeRead('cliente', 'where email=:email', 'email=' . $email);
        
        return $read->getResult();
    }
    
    public function searchByEmailAndId($email, $id)
    {
        $read = new Read();
        $read->ExeRead('cliente', 'WHERE email=:email AND id=:id', 
            'email=' . $email . '&id=' . $id);
        return count($read->getResult()) > 0 ? $read->getResult() : false;
    }
    
    public function hasContrato(int $id)
    {
        $read = new Read();
        $read->ExeRead('cliente', 'WHERE id=:id AND contrato_id IS NOT NULL',
            'id='.$id);
        return true === count($read->getResult()) > 0;
    }
}