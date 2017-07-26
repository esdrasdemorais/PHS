<?php

//namespace _app\DAO;

//use _app\Model\Endereco as Endereco;

/**
 * EnderecoDAO [ TIPO ]
 * Descrição
 * @copyright (c) year, Victor Hugo Garcia Caetano - SP
 */
class EnderecoDAO extends Object
{
    public function alterar(Endereco $endereco)
    {
        $update = new Update();

        try {
            $update->ExeUpdate("endereco", (array) $endereco, 'where id=:id', 
                ':id='.$endereco->getId());
            return $endereco;
        } catch (Exception $ex) {  
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine()); 
        }
    }

    public function listar($id = null)
    {
        $arrEndereco = array();
        $read = new Read();
        
        if (is_numeric($id)) {
            $read->ExeRead('endereco', 'where id=:id', 'id=' . $id);
        } else {
            $read->ExeRead('endereco');
        }

        foreach($read->getResult() as $end) {
            $arrEndereco[] = $this->setEndereco($end);
        }

        return $arrEndereco;
    }
    
    private function setEndereco(array $end)
    {
        $endereco = new Endereco();
        $endereco->setId($end['id']);
        $endereco->setLogradouro($end['logradouro']);
        $endereco->setBairro($end['bairro']);
        $endereco->setCidade($end['cidade']);
        $endereco->setEstado($end['estado']);
        $endereco->setCep($end['cep']);
        $endereco->setNumero($end['numero']);

        return $endereco;
    }

    public function salvar(Endereco $endereco)
    {
        $create = new Create();
        try {
            $create->ExeCreate('endereco', $this->toArray($endereco));
            if (is_numeric($create->getResult())){
                $endereco->setId($create->getResult());
                return $endereco;
            } else {
                throw new Exception('Não foi possível realizar seu cadastro.');
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
                $ex->getLine());                                   
        }
    }

    public function deletar(Endereco $endereco)
    {
        $delete = new Delete();

        try {
            $delete->ExeDelete('endereco', 'where id= :id', ':id=' . 
                $endereco->getId());
            if($delete->getResult() === true){
                return "Endereço removido com sucesso!";      
            } else {
                throw new Exception("Não foi possível remover o endereco.");
            }
        } catch (Exception $ex) {
            PHPErro($ex->getCode(), $ex->getMessage(), $ex->getFile(), 
            $ex->getLine()); 
        }
    }
    
    public function setMapsApiEndereco($endereco, $arrEndereco)
    {
        $arrEnd = explode(",", str_replace("+", " ", $arrEndereco['endereco']));
        $endereco->setLogradouro($arrEnd[0]);
        
        $arrNumeroBairro = explode("-", $arrEnd[1]);
        $endereco->setNumero(trim($arrNumeroBairro[0]));
        $endereco->setBairro(trim($arrNumeroBairro[1]));
        
        $arrCidadeEstado = explode("-", $arrEnd[2]);
        $endereco->setCidade(trim($arrCidadeEstado[0]));
        $endereco->setEstado(trim($arrCidadeEstado[1]));

        $arrEnd[3] = trim(str_replace("-", "", $arrEnd[3]));
        $endereco->setCep(is_numeric($arrEnd[3]) ? $arrEnd[3] : '');
        
        $endereco->setGeoLocalizacao($arrEndereco['geo']);
    }
    
    public function searchByEndereco($endereco)
    {
        $read = new Read();
        $read->ExeRead('endereco', "WHERE geoLocalizacao=:geoloc",
            "geoloc=" . $endereco->getGeoLocalizacao());
        return $read->getResult()[0];
    }
}
