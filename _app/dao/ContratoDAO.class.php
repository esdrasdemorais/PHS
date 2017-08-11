<?php
/**
 * Description of ContratoDAO
 *
 * @author esdrassilva
 */
class ContratoDAO extends Object
{
    private $contrato;
    
    public function alterar(Contrato $contrato)
    {
        $update = new Update();
        try {
            $update->ExeUpdate("contrato", $this->toArray($contrato), 
                'where id=:id', ':id='.$contrato->getId());
            return $contrato;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrContrato = array();              
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('contrato', "where id=:id and ativo='1'", 
                'id=' . $id);
        } else {
            $read->ExeRead('contrato');
        }
        
        foreach($read->getResult() as $des) {
            $contrato = new Contrato();
            $contrato->setId($des['id']);
            $contrato->setNome($des['nome']);
            $contrato->setIcon($des['icon']);
            $arrContrato[] = $contrato;
        }
        
        return $arrContrato;
    }
   
    public function setContrato($arrContrato)
    {
        $this->contrato = new Contrato();
        $this->contrato->setId($arrContrato['id']);
        $this->contrato->setNumero($arrContrato['numero']);
        $this->contrato->setData($arrContrato['data']);
        $this->contrato->setQtdDiarias($arrContrato['qtdDiarias']);
        $this->contrato->setValor($arrContrato['valor']);
        return $this->contrato;
    }
    
    public function salvar(Contrato $contrato)
    {
        $create = new Create();
        try {
            $create->ExeCreate('contrato', $this->toArray($contrato));
            if(is_numeric($create->getResult())){
                $contrato->setId($create->getResult());
                return $contrato;
            } else {
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());
        }
    }
    
    public function deletar(Contrato $contrato)
    {
        $delete = new Delete();
        try {
            $delete->ExeDelete('contrato', 'where id=:id', 
                'id='.$contrato->getId());
            if($delete->getResult() === true){
                return "Contrato removido com sucesso!";      
            } else {
                throw new Exception("Não foi possível remover o contrato.");
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }
}