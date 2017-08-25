<?php

//namespace _app\dao;
//
//use _app\Model\Servico as Servico;

/**
 * DiscriminacaoDAO.class.php [ TIPO ]
 * Descrição
 * @copyright (c) year, Esdras de Morais da Silva - SP
 */
class DiscriminacaoDAO extends Object
{
    public function alterar(ServicoDescricao $discriminacao)
    {
        $update = new Update();
        try {
	    $update->ExeUpdate("servico_descricao", $this->toArray(
		$discriminacao), 'where id=:id', 
		':id='.$discriminacao->getId());
            return $discriminacao;
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());
        }
    }

    public function listar($id = null)
    {
        $arrDiscriminacao = array();
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('servico_descricao', "where id=:id and status='1'", 
                'id=' . $id);
        } else {
            $read->ExeRead('servico_descricao');
        }
        
        foreach ($read->getResult() as $des) {
            $servicoDescricao = new ServicoDescricao();
            $servicoDescricao->setId($des['id']);
            $servicoDescricao->setServico($des['nome']);
            $servicoDescricao->setDescricao($des['icon']);
            $arrDiscriminacao[] = $servicoDescricao;
        }
        
        return $arrDiscriminacao;
    }
      
    public function salvar(ServicoDescricao $servicoDescricao)
    {
        $create = new Create();
        try{
	    $create->ExeCreate('servico_descricao', $this->toArray(
		$servicoDescricao));
            if(is_numeric($create->getResult())){
                $servicoDescricao->setId($create->getResult());
                return $servicoDescricao;
            } else {
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());
        }
    }
    
    public function deletar(ServicoDescricao $servicoDescricao)
    {
        $delete = new Delete();
        try {
            $delete->ExeDelete('servico_descricao', 'where id=:id', 
                'id='.$servicoDescricao->getId());
            if($delete->getResult() === true){
                return "Descricao do Servico removida com sucesso.";
            } else {
                throw new Exception("Não foi possível remover o servico.");
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }
}
