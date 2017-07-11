<?php

//namespace _app\DAO;

//use _app\Model\Endereco as Endereco;

/**
 * EnderecoDAO [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class EnderecoDAO {
    public function alterar(Endereco $endereco)
    {
        $update = new Update();

        try {
          $update->ExeUpdate("endereco", (array)$endereco, 'where id=:id', ':id='.$endereco->getId());
          //return $endereco;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrEndereco = array();

        if (is_numeric($id)) {
            $read->ExeRead('endereco', 'id=:id', ':id=' . $id);
        } else {
            $read->ExeRead('endereco');
        }

        foreach($read->getResult() as $end) {
            $arrEndereco[] = $this->setEndereco($end);
        }

        return $arrEndereco;
    }
    
    private function setEndereco(array $end)
    {
        $endereco = new Endereco();
        $endereco->setId($end['id']);
        $endereco->setLogradouro($end['logradouro']);
        $endereco->setBairro($end['bairro']);
        $endereco->setCidade($end['cidade']);
        $endereco->setEstado($end['estado']);
        $endereco->setCep($end['cep']);
        $endereco->setNumero($numero);//@todo

        $readEndereco = new Read();
        $readEndereco->ExeRead('endereco', 'where id=:id', ':id = ' . $end['endereco_id']); 

        return $readEndereco->getResult()[0];
    }

    public function salvar(Endereco $endereco)
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

    public function deletar(Endereco $endereco)
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
