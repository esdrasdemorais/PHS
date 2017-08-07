<?php

/**
 * ServicoDescricaoDAO [ TIPO ]
 * Descrição
 * @copyright (c) year, Esdras de Morais da Silva - SP
 */
class ServicoDescricaoDAO
{
    public function alterar(ServicoDescricao $servicoDescricao)
    {
        $update = new Update();
        try {
            $arrServicoDescricao = array('descricao_id'=>
            $servicoDescricao->getDescricao(), 'servico_id'=>
            $servicoDescricao->getServico());
            $update->ExeUpdate("servico_descricao", $arrServicoDescricao, 
                'where id=:id', ':id='.$servicoDescricao->getId());
            return $servicoDescricao;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrServicoDescricao = array();

        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('cliente', 'where id=:id', 'id=' . $id);
        } else {
            $read->ExeRead('servico_descricao');
        }
        foreach($read->getResult() as $end) {
            $arrServicoDescricao[] = $this->setServicoDescricao($end);
        }
        return $arrServicoDescricao;
    }
    
    private function setServicoDescricao(array $end)
    {
        $servicoDescricao = new ServicoDescricaoDAO();
        $servicoDescricao->setId($end['id']);
        $servicoDescricao->setDescricao($end['descricao_id']);
        $servicoDescricao->setServicoDescricao($end['servico_id']);
        return $servicoDescricao;
    }

    public function salvar(ServicoDescricao $servicoDescricao)
    {
        $create = new Create();
        try{
            $arrServicoDescricao = array('descricao_id'=>
            $servicoDescricao->getDescricao(), 'servico_id'=>
            $servicoDescricao->getServico());
            $create->ExeCreate('servico_descricao', $arrServicoDescricao);
            if(is_numeric($create->getResult())){
                $servicoDescricao->setId($create->getResult());
                return $servicoDescricao;
            } else{
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
            $delete->ExeDelete('servico_descricao', 'where id= :id', 
                'id='.$servicoDescricao->getId());
            if($delete->getResult() === true){
                return "Endereço removido com sucesso!";      
            } else {
                throw new Exception("Erro ao remover o Descrição do Serviço.");
            }

        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }

    }
}
