<?php
/**
 * Description of ServicoAvaliacaoDAO
 *
 * @author esdrassilva
 */
class ServicoAvaliacaoDAO extends Object
{
    public function alterar($servicoAvaliacao)
    {
        $update = new Update();
        try {
            $update->ExeUpdate("servico_agendamento_avaliacao",[
                'data'=>$servicoAvaliacao->getData(),'nota'=>
                $servicoAvaliacao->getNota(),'comentario'=>
                $servicoAvaliacao->getComentario()], 'where id=:id', 
                'id='.$servicoAvaliacao->getId());
            return $servicoAvaliacao;
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrServicoAvaliacao = array();
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('servico_agendamento_avaliacao', 'where id=:id',
                'id='.$id);
        } else {
            $read->ExeRead('servico_agendamento_avaliacao');
        }
        foreach($read->getResult() as $servico) {
            $arrServicoAvaliacao[] = $this->setServicoAvaliacao($servico);
        }
        return $arrServicoAvaliacao;
    }
    
    public function setServicoAvaliacao(array $servico)
    { 
        $servicoAvaliacao = new ServicoAvaliacao();
        $servicoAvaliacao->setId(isset($servico['id'])?$servico['id']:'');
        $servicoAgendamentoDAO = new ServicoAgendamentoDAO();
        $servicoAvaliacao->setServicoAgendamento(
            $servicoAgendamentoDAO->listar(
                $servico['servico_agendamento_id'])[0]);
        #$servicoAvaliacao->setData($servico['data']);
        $servicoAvaliacao->setNota($servico['nota']);
        $servicoAvaliacao->setComentario($servico['comentario']);
        return $servicoAvaliacao;
    }
    
    public function salvar($servicoAvaliacao)
    {
        $create = new Create();
        try {
            $servicoAgendamento = $servicoAvaliacao->getServicoAgendamento();
            $arrServico = array(/*'data'=>$servicoAvaliacao->getData(),*/
                'servico_cliente_agendamento_id'=>$servicoAgendamento->getId(),
                'nota'=>$servicoAvaliacao->getNota(),'comentario'=>
                $servicoAvaliacao->getComentario());
            $create->ExeCreate('servico_agendamento_avaliacao', $arrServico);
            if (is_numeric($create->getResult())) {
                $servicoAvaliacao->setId($create->getResult());
                return $servicoAvaliacao;
            } else {
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());                                   
        }
    }
    
    public function deletar($servicoAvaliacao)
    {
        $delete = new Delete();
        try {
	        $delete->ExeDelete("servico_agendamento_avaliacao", 'where id=:id', 
		    'id=' . $servicoAvaliacao->getId());
            if ($delete->getResult() === true){
                return "Serviço removido com sucesso!";      
            } else {
                throw new Exception("Não foi possível remover o serviço.");
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }
}
