<?php

include_once '../classes/Setores';
$objSetores = new Setores();

$acao = $_REQUEST['acao'];

switch ($acao) {
    case 'excluir':
        $setorID = $_GET['id'];
        $objSetores->excluirSetor($setorID);
        break;
        case 'salvar':
            $setorID = $_POST['SetorID'];
            $nome = $_POST['Nome'];
            $andar = $_POST['Andar'];
            $cor = $_POST['Cor'];  
            $objSetores->salvarSetor($setorID);
            break;
            default:
            #code...
            break;
}

header("Location: ../setores.php");

