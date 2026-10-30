<?php
include_once 'config.php';

$objSetores = new Setores();
$resultado = $objSetores -> exibirSetores();

class setores{

    public $SetorID;
    public $Nome;
    public $Andar;
    public $Cor;
    public $ConexaoDB;

    function __construct() {
        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->ConexaoDB->set_charset(DB_CHARSET);
    }

    public function exibirSetores() {
        $sql = 'SELECT * FROM setores';
        $resultado = $this->ConexaoDB->query($sql);

        if ($resultado->num_rows > 0) {

            $registros = array();

            while ($row = $resultado->fetch_assoc()) {
                array_push($registros, $row);
            }

            return $registros;

        } else {
            return 'Sem registros';
        }
    }

    public function exibirSetor($setorID) {

        if ($setorID != '' && is_numeric($setorID)) {

            $sql = 'SELECT * FROM setores
                    WHERE SetorID = ' . $setorID;

            $resultado = $this->ConexaoDB->query($sql);

            if ($resultado->num_rows > 0) {

                $dados = $resultado->fetch_assoc();

                return $dados;

            } else {
                return 'Registro nao localizado';
            }

        } else {
            return 'SetorID invalido';
        }
    }

    public function excluirSetor($setorID) {

        if ($setorID != '' && is_numeric($setorID)) {

            $sql = 'DELETE FROM setores
                    WHERE SetorID = ' . $setorID;

            if ($this->ConexaoDB->query($sql) === TRUE) {
                return 'Setor excluido com Sucesso!';
            } else {
                return 'Erro ao excluir o SetorID = ' . $setorID;
            }

        } else {
            return 'SetorID invalido';
        }
    }

    public function salvarSetor($setorID) {

        if (is_numeric($setorID) && $setorID > 0) {

            $sql = 'UPDATE setores
                    SET Nome = "' . $this->Nome . '",
                        Andar = "' . $this->Andar . '",
                        Cor = "' . $this->Cor . '"
                    WHERE SetorID = ' . $setorID;

        } else {

            $sql = 'INSERT INTO setores
                    (Nome, Andar, Cor)
                    VALUES (
                        "' . $this->Nome . '",
                        "' . $this->Andar . '",
                        "' . $this->Cor . '"
                    )';
        }

        if ($this->ConexaoDB->query($sql) === TRUE) {
            return 'Registro salvo com sucesso!';
        } else {
            return 'Erro ao salvar o Registro!';
        }
    }

    public function __destruct() {

        if ($this->ConexaoDB !== null) {
            $this->ConexaoDB->close();
            $this->ConexaoDB = null;
        }
    }
}
?>