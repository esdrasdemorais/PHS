<?php

namespace _app\DAO;

use _app\Model\Baba as Baba;

/**
 * BabaDAO.class.php [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class BabaDAO
{  
    public function alterar(Baba $baba)
    {
        $update = new Update();

        try {
          $update->ExeUpdate("servico", (array)$baba, 'where id=:id and tipo=:tipo', ':id='.$baba->getId().' :tipo='.ServicoTipo::Baba);
          //return $baba;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }
    }
    
    public function listar($id = null)
    {
        $arrBaba = array();                
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('servico', 'id=:id and tipo=:tipo', ':id='.$id.' :tipo='.ServicoTipo::Baba);
        } else {
            $read->ExeRead('baba');
        }        
        foreach($read->getResult() as $servico) {
            $arrBaba[] = $this->setServico($servico);
        }        
        return $arrBaba;
    }
    
    private function setServico(array $servico)
    {
        $baba = new Baba();
        $baba->setId($servico['id']);
        $baba->setData($servico['data']);
        $baba->setHora($servico['hora']);
        $baba->setPeriodo($servico['periodo']);
        $baba->setValorHora($servico['valorhora']);
        $baba->setValorTotal($servico['valortotal']);
        $endereco = new EnderecoDAO();           
        $baba->setEndereco($endereco->listar($servico['endereco_id'])[0]);               
        $cliente = new ClienteDAO();           
        $baba->setCliente($cliente->listar($servico['cliente_id'])[0]);                       
        return $baba;
    }
      
      public function salvar(Baba $baba)
      {
          $create = new Create();
                    
          try{
            $arrbaba = (array)$baba;
            $arrbaba['tipo'] = ServicoTipo::Baba;
            $create->ExeCreate('baba', $arrbaba);
            if(is_numeric($create->getResult())){
                $baba->setId($create->getResult());
                return $baba;
            } else{
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
          } catch (Exception $ex) {
              PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());                                   
          }
      }
      
      public function deletar(Baba $baba)
      {
          $delete = new Delete();
          
          try {
              $delete->ExeDelete("servico", (array)$baba, 'where id=:id and tipo=:tipo', ':id='.$baba->getId().' :tipo='.ServicoTipo::Baba);
              if($delete->getResult() === true){
                  return "Baba removido com sucesso!";      
              } else {
                  throw new Exception("Não foi possível remover o baba.");
              }
                  
          } catch (Exception $ex) {
                 PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
          }
         
      }
      
}
