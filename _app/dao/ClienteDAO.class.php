<?php

//namespace _app\DAO;
//
//use _app\Model\Cliente as Cliente;

/**
 * ClienteDAO.class.php [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class ClienteDAO
{  
    public function alterar(Cliente $cliente)
    {
        $update = new Update();

        try {
          $update->ExeUpdate("cliente", (array)$cliente, 'where id=:id', ':id='.$cliente->getId());
          //return $cliente;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }
    }
    
    public function listar($id = null)
    {
        $arrCliente = array();
                
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('cliente', 'id=:id', ':id=' . $id);
        } else {
            $read->ExeRead('cliente');
        }
        
        foreach($read->getResult() as $cli) {
            $cliente = new Cliente();
            $cliente->setId($cli['id']);
            $cliente->setNome($cli['nome']);
            $cliente->setEmail($cli['email']);
            $cliente->setNumero($cli['numero']);
            $cliente->setGeoLocalizacao($cli['geolocalizacao']);

            $endereco = new EnderecoDAO();           
            
            $cliente->setEndereco($endereco->listar($cli['endereco_id'])[0]);   // Um para um         
            
            $arrCliente[] = $cliente;
        }
        
        return $arrCliente;
    }

	public function salvar(Cliente $cliente)
	{
		$create = new Create();
				
		try{
			$create->ExeCreate('cliente', (array)$cliente);
			if(is_numeric($create->getResult())){
				$cliente->setId($create->getResult());
				return $cliente;
			} else{
				throw new Exception('Não foi possível realizar seu cadastro.');
			}
		} catch (Exception $ex) {
			PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());                                   
		}
	}

	public function deletar(Cliente $cliente)
	{
		$delete = new Delete();

		try {
			$delete->ExeDelete('cliente', 'where id= :id', ':id='.$cliente->getId());
			if($delete->getResult() === true){
			  return "Cliente removido com sucesso!";      
			} else {
			  throw new Exception("Não foi possível remover o cliente.");
			}  
		} catch (Exception $ex) {
			 PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
		}	 
	}
}
