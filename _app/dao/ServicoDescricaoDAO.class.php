<?php

/**
 * ServicoEnderecoDAO [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class ServicoEnderecoDAO {
    public function alterar(ServicoEndereco $endereco)
    {
        $update = new Update();

        try {
          $update->ExeUpdate("endereco", (array)$endereco, 'where id=:id', ':id='.$endereco->getId());
          //return $endereco;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }
    }

    public function listar()
    {
        $arrServicoEndereco = array();

        $read = new Read();
        $read->ExeRead('endereco');

        foreach($read->getResult() as $end) {
            $arrServicoEndereco[] = $this->setServicoEndereco($end);
        }

        return $arrServicoEndereco;
    }
    
    private function setServicoEndereco(array $end)
    {
        $endereco = new ServicoEndereco();
        $endereco->setId($end['id']);
        $endereco->setLogradouro($end['logradouro']);
        $endereco->setBairro($end['bairro']);
        $endereco->setCidade($end['cidade']);
        $endereco->setEstado($end['estado']);
        $endereco->setCep($end['cep']);

        $readServicoEndereco = new Read();
        $readServicoEndereco->ExeRead('endereco', 'where id=:id', ':id = ' . $end['endereco_id']); 

        return $readServicoEndereco->getResult()[0];
    }

    public function salvar(ServicoEndereco $endereco)
    {
        $create = new Create();

        try{
          $create->ExeCreate('endereco', (array)$endereco);
          if(is_numeric($create->getResult())){
              $endereco->setId($create->getResult());
              return $endereco;
          } else{
              throw new Exception('Não foi possível realizar seu cadastro.');
          }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());                                   
        }
    }

    public function deletar(ServicoEndereco $endereco)
    {
        $delete = new Delete();

        try {
            $delete->ExeDelete('endereco', 'where id= :id', ':id='.$endereco->getId());
            if($delete->getResult() === true){
                return "Endereço removido com sucesso!";      
            } else {
                throw new Exception("Não foi possível remover o endereco.");
            }

        } catch (Exception $ex) {
               PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }

    }
}
