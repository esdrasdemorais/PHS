<?php
/**
 * Description of ServicoAgendamentoDAO
 *
 * @author esdrassilva
 */
class ServicoAgendamentoDAO extends Object
{
    public function alterar($servicoAgendamento)
    {
        $update = new Update();
        try {
            $update->ExeUpdate("servico_cliente_agendamento",[
                'data'=>$servicoAgendamento->getData(),'hora'=>
                $servicoAgendamento->getHora(),'periodo'=>
                $servicoAgendamento->getPeriodo(),'valorTotal'=>
                $servicoAgendamento->getValorTotal(),'emailEnviado'=>
                $servicoAgendamento->getEmailEnviado(),'qtdDiarias'=>
                $servicoAgendamento->getQtdDiarias()], 'where id=:id', 
                'id='.$servicoAgendamento->getId());
            return $servicoAgendamento;
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrServicoAgendamento = array();
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('servico_cliente_agendamento', 'where id=:id',
                'id='.$id);
        } else {
            $read->ExeRead('servico_cliente_agendamento');
        }
        foreach($read->getResult() as $servico) {
            $arrServicoAgendamento[] = $this->setServicoAgendamento($servico);
        }
        return $arrServicoAgendamento;
    }
    
    public function setServicoAgendamento(array $servico)
    { 
        $servicoAgendamento = new ServicoAgendamento();
        $servicoAgendamento->setId(isset($servico['id'])?$servico['id']:'');
        $servicoAgendamento->setData($servico['data']);
        $servicoAgendamento->setHora($servico['hora']);
        if (isset($servico['qtdDiarias'])) {
            $servicoAgendamento->setQtdDiarias($servico['qtdDiarias']);
        } else {
            $servicoAgendamento->setPeriodo($servico['periodo']);
        }
        $endereco = new EnderecoDAO();
        if(isset($servico['endereco_id'])) {
            $servicoAgendamento->setEndereco(
	            $endereco->listar($servico['endereco_id'])[0]);
        }
	    $servicoClienteDAO = new ServicoClienteDAO();
	    $servicoAgendamento->setServicoCliente(
	    $servicoClienteDAO->listar($servico['servico_cliente_id'])[0]);
        return $servicoAgendamento;
    }
    
    public function salvar($servicoAgendamento)
    {
        $create = new Create();
        try {
            $arrServico = array('data'=>$servicoAgendamento->getData(),'hora'=>
                $servicoAgendamento->getHora(),'periodo'=>
		        $servicoAgendamento->getPeriodo(),'servico_cliente_id'=>
        		$servicoAgendamento->getServicoCliente(),'valorTotal'=>
		        $servicoAgendamento->getValorTotal(),'qtdDiarias'=>
                $servicoAgendamento->getQtdDiarias());
            $create->ExeCreate('servico_cliente_agendamento', $arrServico);
            if (is_numeric($create->getResult())) {
                $servicoAgendamento->setId($create->getResult());
                return $servicoAgendamento;
            } else {
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());                                   
        }
    }
    
    public function deletar($servicoAgendamento)
    {
        $delete = new Delete();
        try {
	    $delete->ExeDelete("servico_cliente_agendamento", 'where id=:id', 
		'id=' . $servicoAgendamento->getId());
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
