<?php

/**
 * ServicoDescricaoDAO [ TIPO ]
 * Descrição
 * @copyright (c) year, Esdras de Morais da Silva - SP
 */
class ServicoDescricaoDAO extends Object
{
    public function alterar(ServicoDescricao $servicoDescricao)
    {
        $update = new Update();
        try {
	    $update->ExeUpdate("endereco", $this->toArray($servicoDescricao),
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
            $read->ExeRead('servico_cliente_descricao', "where id=:id", 
		'id=' . $id);
        } else {
	    $read->ExeRead('servico_cliente_descricao');
	}
        foreach ($read->getResult() as $serDesc) {
            $arrServicoDescricao[] = $this->setServicoDescricao($serDesc);
        }
        return $arrServicoDescricao;
    }

    public function setServicoDescricao($arrServDesc)
    {
    	$servicoDescricao = new ServicoDescricao();
	$servicoDescricao->setId($arrServDesc['id']);
	$servicoClienteDAO = new ServicoClienteDAO();
	$servicoCliente = $servicoClienteDAO->listar(
	    $arrServDesc['servico_cliente_id'])[0];
	$servicoDescricao->setServicoCliente($servicoCliente);
	$descricaoDAO = new DescricaoDAO();
	$descricao = $descricaoDAO->listar($arrServDesc['descricao_id'])[0];
	$servicoDescricao->setDescricao($descricao);
	return $servicoDescricao;
    }
    
    public function setServicosDescricao(array $serDesc)
    {
	$arrServicoDescricao = array();
	$servicoDescricaoDAO = new ServicoDescricaoDAO();
	foreach ($serDesc['ids'] as $descricaoId) {
            $descricaoDAO = new DescricaoDAO();
	    $descricao = $descricaoDAO->listar($descricaoId)[0];
	    $arrServicoDescricao[] = ['descricao_id'=>$descricao->getId(),
		'servico_cliente_id'=>$serDesc['servico_cliente_id']];
	}
	return $arrServicoDescricao;
    }

    public function salvar(array $arrServicoDescricao)
    {
	$create = new Create();
	$arrServicosDescricao = array();
	try {
	    foreach ($arrServicoDescricao as $servicoDescricao) {
		$create->ExeCreate('servico_cliente_descricao',
		    $servicoDescricao);
            	if (is_numeric($create->getResult())) {
		    $arrServicosDescricao[] = $this->listar(
			    $create->getResult())[0];

            	} else {
		    throw new Exception(
			'Não foi possível realizar seu cadastro.');
		}
	    }
	    return $arrServicosDescricao;
        } catch (Exception $ex) {
	    PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(),
		$ex->getLine());
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
