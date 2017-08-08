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
            $update->ExeUpdate("servico_agendamento", 
                $this->toArray($servicoAgendamento), 'where id=:id', 
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
            $read->ExeRead('servico_agendamento', 'id=:id', 'id='.$id);
        } else {
            $read->ExeRead('servico_agendamento');
        }
        foreach($read->getResult() as $servico) {
            $arrServicoAgendamento[] = $this->setServico($servico);
        }
        return $arrServicoAgendamento;
    }
    
    public function setServicoAgendamento(array $servico)
    {
        $servicoAgendamento = new ServicoAgendamento();
        $servicoAgendamento->setId($servico['id']);
        $servicoAgendamento->setData($servico['data']);
        $servicoAgendamento->setHora($servico['hora']);
        $servicoAgendamento->setPeriodo($servico['periodo']);
        $endereco = new EnderecoDAO();           
        $servicoAgendamento->setEndereco(
            $endereco->listar($servico['endereco_id'])[0]);
        $cliente = new ClienteDAO();
        $servicoAgendamento->setCliente(
            $cliente->listar(Session::get('cliente_id'))[0]);
        $servico = new ServicoDAO();
        $servicoAgendamento->setServico(
            $servico->listar($servico['tipo'])[0]);
        return $servicoAgendamento;
    }
    
    public function salvar($servicoAgendamento)
    {
        $create = new Create();
        try {
            $arrServico = array('data'=>$servicoAgendamento->getData(),'hora'=>
                $servicoAgendamento->getHora(),'periodo'=>
                $servicoAgendamento->getPeriodo(),'cliente_id'=>
                $servicoAgendamento->getCliente()->getId(), 'servico_id'=>
                $servicoAgendamento->getServico()->getId());
            $create->ExeCreate('servico_agendamento', $arrServico);
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
            $delete->ExeDelete("servico_agendamento", 'where id=:id', 'id='.
                $servicoAgendamento->getId());
            if($delete->getResult() === true){
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