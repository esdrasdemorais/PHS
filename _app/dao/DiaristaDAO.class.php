<?php

namespace _app\DAO;

use _app\Model\Diarista as Diarista;

/**
 * DiaristaDAO.class.php [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class DiaristaDAO
{
    public function alterar(Diarista $diarista)
    {
        $update = new Update();

        try {
          $update->ExeUpdate("servico", (array)$diarista, 'where id=:id and tipo=:tipo', ':id='.$diarista->getId().' :tipo='.ServicoTipo::Diarista);
          //return $diarista;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }
    }
    
    public function listar($id = null)
    {
        $arrDiarista = array();                
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('servico', 'id=:id and tipo=:tipo', ':id='.$id.' :tipo='.ServicoTipo::Diarista);
        } else {
            $read->ExeRead('diarista');
        }        
        foreach($read->getResult() as $servico) {
            $arrDiarista[] = $this->setServico($servico);
        }        
        return $arrDiarista;
    }
    
    private function setServico(array $servico)
    {
        $diarista = new Diarista();
        $diarista->setId($servico['id']);
        $diarista->setData($servico['data']);
        $diarista->setHora($servico['hora']);
        $diarista->setPeriodo($servico['periodo']);
        $diarista->setValorHora($servico['valorhora']);
        $diarista->setValorTotal($servico['valortotal']);
        $endereco = new EnderecoDAO();           
        $diarista->setEndereco($endereco->listar($servico['endereco_id'])[0]);               
        $cliente = new ClienteDAO();           
        $diarista->setCliente($cliente->listar($servico['cliente_id'])[0]);                       
        return $diarista;
    }
      
    public function salvar(Diarista $diarista)
    {
        $create = new Create();

        try{
          $arrdiarista = (array)$diarista;
          $arrdiarista['tipo'] = ServicoTipo::Diarista;
          $create->ExeCreate('diarista', $arrdiarista);
          if(is_numeric($create->getResult())){
              $diarista->setId($create->getResult());
              return $diarista;
          } else{
              throw new Exception('Não foi possível realizar seu cadastro.');
          }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());                                   
        }
    }
      
    public function deletar(Diarista $diarista)
    {
        $delete = new Delete();

        try {
            $delete->ExeDelete("servico", (array)$diarista, 'where id=:id and tipo=:tipo', ':id='.$diarista->getId().' :tipo='.ServicoTipo::Diarista);
            if($delete->getResult() === true){
                return "Diarista removido com sucesso!";      
            } else {
                throw new Exception("Não foi possível remover o diarista.");
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }
    }
}
