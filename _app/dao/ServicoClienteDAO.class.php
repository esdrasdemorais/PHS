<?php
/**
 * Description of ServicoClienteDAO
 *
 * @author esdrassilva
 */
class ServicoClienteDAO extends Object
{
    public function alterar($servicoCliente)
    {
        $update = new Update();
        try {
            $update->ExeUpdate("servico_cliente", 
                $this->toArray($servicoCliente), 'where id=:id', 
                'id='.$servicoCliente->getId());
            return $servicoCliente;
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrServicoCliente = array();
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('servico_cliente', 'where id=:id', 'id='.$id);
        } else {
            $read->ExeRead('servico_cliente');
	}
	foreach ($read->getResult() as $servCliente) {
	    $servicoCliente = new ServicoCliente();
	    $servicoCliente->setId($servCliente['id']);
	    $clienteDAO = new ClienteDAO();
	    $cliente = $clienteDAO->listar($servCliente['cliente_id'])[0];
	    $servicoCliente->setCliente($cliente);
	    $servicoCliente->setServico($servCliente['servico_id']);
	    $servicoCliente->setData($servCliente['data']);
            $arrServicoCliente[] = $servicoCliente;
        }
        return $arrServicoCliente;
    }
    
    public function setServicoCliente(array $servCliente)
    {
        $servicoCliente = new ServicoCliente();
	$servicoCliente->setId($servCliente['id']);
	$clienteDAO = new ClienteDAO();
	$cliente = $clienteDAO->listar($servCliente['cliente'])[0];
	$servicoCliente->setCliente($cliente);
	$servicoName = ucfirst($servCliente['servico']);
	$servicoId = constant('ServicoTipo::' . $servicoName);
	$servicoCliente->setServico($servicoId);
	$servicoCliente->setData(date('Y-m-d'));
        return $servicoCliente;
    }
    
    public function salvar($servicoCliente)
    {
        $create = new Create();
        try {
	    $arrServicoCliente = array('cliente_id'=>
		$servicoCliente->getCliente(),'servico_id'=>
		$servicoCliente->getServico(),'data'=>
		$servicoCliente->getData());
            $create->ExeCreate('servico_cliente', $arrServicoCliente);
            if (is_numeric($create->getResult())) {
                $servicoCliente->setId($create->getResult());
                return $servicoCliente;
            } else {
                throw new Exception('Não foi possível cadastrar o serviço.');
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());                                   
        }
    }
    
    public function deletar($servicoCliente)
    {
        $delete = new Delete();
        try {
            $delete->ExeDelete("servico_cliente", 'where id=:id', 'id='.
                $servicoCliente->getId());
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
