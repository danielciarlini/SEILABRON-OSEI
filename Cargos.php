<?php
 
class Cargos{
 
    public $CargoID;
    public $Nome;
    public $TetoSalarial;
    public $ConexaoDB; 
 
    function __construct(){

        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->ConexaoDB->set_charset(DB_CHARSET);
    }
 
    public function exibirCargos(){

        $sql = 'SELECT * FROM cargos';

        $resultado = $this->ConexaoDB->query($sql);
 
        if($resultado->num_rows > 0){

            $registros = array();
            while($row = $resultado->fetch_assoc()){
                array_push($registros,$row);
            }
            return $registros;
        }else{
            return 'Sem registros';
        }
    }
 
    public function exibirCargo($cargoID){
 
        if( $cargoID != '' && is_numeric($cargoID) ){
           
            $sql = 'SELECT * FROM cargos WHERE cargoID = ' .$cargoID;
            $resultado = $this->ConexaoDB->query($sql);
 
            if( $resultado->num_rows >0){
                $dados = $resultado ->fetch_assoc();
                return $dados;
            }else{
                return 'Registro nao localizado';
            }
        }
    }
 
    public function excluirCargo($cargoID){
 
        if($cargoID != '' && is_numeric($cargoID) ){

            $sql = 'DELETE FROM cargos WHERE cargoID =' .$cargoID;
 
            if($this->ConexaoDB->query($sql) === TRUE ){
                return 'Cargo excluido com Sucesso!';
            }else{
                return 'Erro ao excluir o CargoID =' . $cargoID;
            }
 
        }else{
            return 'CargoID invalido';
        }
 
    }
 
    public function salvarCargo($cargoID){
 
        if( is_numeric($cargoID)) {
 
            $sql = 'UPDATE cargos
                    SET Nome = "'.$this->Nome.'",
                        TetoSalarial = '.$this->TetoSalarial.'
                    WHERE CargoID = '.$cargoID;
 
        }else{
 
            $sql = 'INSERT INTO cargos (Nome,TetoSalarial)
                    VALUES("'.this->Nome.'",'.$this->TetoSalarial.')';
 
        }
 
         if($this->ConexaoDB->query($sql) === TRUE){
            return "Registro salvo com sucesso!";
         }else{
            return "Erro ao salvar o Registro!";
         }
 
    }
 
    
    public function __destruct(){
        $this->ConexaoDB->close();
        $this->ConexaoDB = null;
    }
}

