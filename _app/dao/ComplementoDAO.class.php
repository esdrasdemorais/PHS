<?php

//namespace _app\dao;
//
//use _app\Model\Complemento as Complemento;

/**
 * ComplementoDAO.class.php [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class ComplementoDAO
{
    public function alterar(Complemento $complemento)
    {
        $update = new Update();

        try {
            $update->ExeUpdate("complemento", (array)$complemento, 'where id=:id', ':id='.$complemento->getId());
            //return $complemento;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrComplemento = array();
                
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('complemento', 'id=:id', ':id=' . $id);
        } else {
            $read->ExeRead('complemento');
        }
        
        foreach($read->getResult() as $com) {
            $complemento = new Complemento();
            $complemento->setId($com['id']);
            
            $clienteDAO = new ClienteDAO();
            $cliente = $clienteDAO->listar($com['cliente_id'])[0];
            $complemento->setCliente($cliente);
            
            $enderecoDAO = new EnderecoDAO();
            $endereco = $enderecoDAO->listar($com['endereco_id'])[0];
            $complemento->setEndereco($endereco);
            
            $arrComplemento[] = $complemento;
        }
        
        return $arrComplemento;
    }
      
    public function salvar(Complemento $complemento)
    {
        $create = new Create();

        try{
          $create->ExeCreate('complemento', (array)$complemento);
          if(is_numeric($create->getResult())){
              $complemento->setId($create->getResult());
              return $complemento;
          } else{
              throw new Exception('Não foi possível realizar seu cadastro.');
          }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());                                   
        }
    }
    
    public function deletar(Complemento $complemento)
    {
        $delete = new Delete();

        try {
            $delete->ExeDelete('complemento', 'where id= :id', ':id='.$complemento->getId());
            if($delete->getResult() === true){
                return "Complemento removido com sucesso!";      
            } else {
                throw new Exception("Não foi possível remover o complemento.");
            }

        } catch (Exception $ex) {
               PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }
    }
}
