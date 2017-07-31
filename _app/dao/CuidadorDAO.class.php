<?php

//namespace _app\DAO;
//
//use _app\Model\Cuidador as Cuidador;

/**
 * CuidadorDAO.class.php [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class CuidadorDAO
{  
    public function alterar(Cuidador $cuidador)
    {
        $update = new Update();

        try {
          $update->ExeUpdate("servico", (array)$cuidador, 'where id=:id and tipo=:tipo', ':id='.$cuidador->getId().' :tipo='.ServicoTipo::Cuidador);
          //return $cuidador;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
        }
    }
    
    public function listar($id = null)
    {
        $arrCuidador = array();                
        $read = new Read();
        if (is_numeric($id)) {
            $read->ExeRead('servico', 'id=:id and tipo=:tipo', ':id='.$id.' :tipo='.ServicoTipo::Cuidador);
        } else {
            $read->ExeRead('cuidador');
        }        
        foreach($read->getResult() as $servico) {
            $arrCuidador[] = $this->setServico($servico);
        }        
        return $arrCuidador;
    }
    
    public function setServico(array $servico)
    {
        $cuidador = new Cuidador();
        $cuidador->setId($servico['id']);
        $cuidador->setData($servico['data']);
        $cuidador->setHora($servico['hora']);
        $cuidador->setPeriodo($servico['periodo']);
        $endereco = new EnderecoDAO();           
        $cuidador->setEndereco($endereco->listar($servico['endereco_id'])[0]);               
        $cliente = new ClienteDAO();           
        $cuidador->setCliente($cliente->listar(Session::get('cliente_id'))[0]);                       
        return $cuidador;
    }
      
      public function salvar(Cuidador $cuidador)
      {
          $create = new Create();
                    
          try{
            $arrcuidador = array('data'=>$cuidador->getData(),'hora'=>$cuidador->getHora(),
                'periodo'=>$cuidador->getPeriodo(),'cliente_id'=>$cuidador->getCliente()->getId());
            $arrcuidador['tipo'] = ServicoTipo::Cuidador;
            $create->ExeCreate('servico', $arrcuidador);
            if(is_numeric($create->getResult())){
                $cuidador->setId($create->getResult());
                return $cuidador;
            } else{
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
          } catch (Exception $ex) {
              PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine());                                   
          }
      }
      
      public function deletar(Cuidador $cuidador)
      {
          $delete = new Delete();
          
          try {
              $delete->ExeDelete("servico", (array)$cuidador, 'where id=:id and tipo=:tipo', ':id='.$cuidador->getId().' :tipo='.ServicoTipo::Cuidador);
              if($delete->getResult() === true){
                  return "Cuidador removido com sucesso!";      
              } else {
                  throw new Exception("Não foi possível remover o cuidador.");
              }
                  
          } catch (Exception $ex) {
                 PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), $ex->getLine()); 
          }
         
      }
      
}
