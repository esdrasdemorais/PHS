<?php

//namespace _app\dao;
//
//use _app\Model\Servico as Servico;

/**
 * ServicoDAO.class.php [ TIPO ]
 * Descrição
 * @copyright (c) year, Esdras de Morais da Silva - SP
 */
class ServicoDAO extends Object
{
    public function alterar(Servico $servico)
    {
        $update = new Update();
        try {
            $update->ExeUpdate("servico", $this->toArray($servico), 
                'where id=:id', ':id='.$servico->getId());
            return $servico;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrServico = array();
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('servico', "where id=:id and status='1'", 
                'id=' . $id);
        } else {
            $read->ExeRead('servico');
        }
        
        foreach($read->getResult() as $des) {
            $servico = new Servico();
            $servico->setId($des['id']);
            $servico->setNome($des['nome']);
            $servico->setIcon($des['icon']);
            $arrServico[] = $servico;
        }
        
        return $arrServico;
    }
      
    public function salvar(Servico $servico)
    {
        $create = new Create();
        try {
            $create->ExeCreate('servico', $servico);
            if(is_numeric($create->getResult())){
                $servico->setId($create->getResult());
                return $servico;
            } else {
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());
        }
    }
    
    public function deletar(Servico $servico)
    {
        $delete = new Delete();
        try {
            $delete->ExeDelete('servico', 'where id=:id', 
                'id='.$servico->getId());
            if ($delete->getResult() === true){
                return "Servico removido com sucesso!";      
            } else {
                throw new Exception("Não foi possível remover o servico.");
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }
}
