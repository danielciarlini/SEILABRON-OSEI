<?php
include_once 'config.php';

class Categorias {

    public $CategoriaID;
    public $Nome;
    public $Descricao;
    public $ConexaoDB;

    function __construct() {
        $this->ConexaoDB = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
        $this->ConexaoDB->set_charset(DB_CHARSET);
    }

    public function exibirCategorias() {
        $sql = 'SELECT * FROM Categorias';

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

    public function exibirCategoria($categoriaID) {

        if ($categoriaID != '' && is_numeric($categoriaID)) {

            $sql = 'SELECT * FROM Categorias
                    WHERE CategoriaID = ' . $categoriaID;

            $resultado = $this->ConexaoDB->query($sql);

            if ($resultado->num_rows > 0) {

                $dados = $resultado->fetch_assoc();

                return $dados;

            } else {
                return 'Registro nao localizado';
            }
        }

        return 'CategoriaID invalido';
    }

    public function excluirCategoria($categoriaID) {

        if ($categoriaID != '' && is_numeric($categoriaID)) {

            $sql = 'DELETE FROM Categorias
                    WHERE CategoriaID = ' . $categoriaID;

            if ($this->ConexaoDB->query($sql) === TRUE) {
                return 'Categoria excluida com Sucesso!';
            } else {
                return 'Erro ao excluir a CategoriaID = ' . $categoriaID;
            }

        } else {
            return 'CategoriaID invalido';
        }
    }

    public function salvarCategoria($categoriaID) {

        if (is_numeric($categoriaID) && $categoriaID > 0) {

            $sql = 'UPDATE Categorias
                    SET Nome = "' . $this->Nome . '",
                        Descricao = "' . $this->Descricao . '"
                    WHERE CategoriaID = ' . $categoriaID;

        } else {

            $sql = 'INSERT INTO Categorias (Nome, Descricao)
                    VALUES ("' . $this->Nome . '",
                            "' . $this->Descricao . '")';
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