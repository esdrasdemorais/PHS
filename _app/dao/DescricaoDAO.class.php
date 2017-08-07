<?php

//namespace _app\dao;
//
//use _app\Model\Descricao as Descricao;

/**
 * DescricaoDAO.class.php [ TIPO ]
 * Descrição
 * @copyright (c) year, Esdras de Morais da Silva - SP
 */
class DescricaoDAO
{
    public function alterar(Descricao $descricao)
    {
        $update = new Update();
        try {
            $arrDescricao = array('nome'=>$descricao->getNome(), 'status'=>
                $descricao->getStatus());
            $update->ExeUpdate("descricao", $arrDescricao, 'where id=:id', 
                ':id='.$descricao->getId());
            return $descricao;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrDescricao = array();              
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('descricao', "where id=:id and ativo='1'", 
                'id=' . $id);
        } else {
            $read->ExeRead('descricao');
        }
        
        foreach($read->getResult() as $des) {
            $descricao = new Descricao();
            $descricao->setId($des['id']);
            $descricao->setNome($des['nome']);
            $arrDescricao[] = $descricao;
        }
        
        return $arrDescricao;
    }
      
    public function salvar(Descricao $descricao)
    {
        $create = new Create();
        try{
            $create->ExeCreate('descricao', $descricao);
            if(is_numeric($create->getResult())){
                $descricao->setId($create->getResult());
                return $descricao;
            } else {
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());
        }
    }
    
    public function deletar(Descricao $descricao)
    {
        $delete = new Delete();
        try {
            $delete->ExeDelete('descricao', 'where id=:id', 
                'id='.$descricao->getId());
            if($delete->getResult() === true){
                return "Descricao removido com sucesso!";      
            } else {
                throw new Exception("Não foi possível remover o descricao.");
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }
}