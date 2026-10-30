<?php

include_once 'config.php';
include_once 'setores.php';

$setores = new Setores();
$mensagem = '';
$editar = false;

if (isset($_GET['excluir'])) {
    $mensagem = $setores->excluirSetor($_GET['excluir']);
}

if (isset($_GET['editar'])) {
    $dados = $setores->exibirSetor($_GET['editar']);

    if (is_array($dados)) {
        $editar = true;
        $setores->SetorID = $dados['SetorID'];
        $setores->Nome = $dados['Nome'];
        $setores->Andar = $dados['Andar'];
        $setores->Cor = $dados['Cor'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $setores->Nome = $_POST['Nome'];
    $setores->Andar = $_POST['Andar'];
    $setores->Cor = $_POST['Cor'];

    $id = isset($_POST['SetorID']) ? $_POST['SetorID'] : '';

    $mensagem = $setores->salvarSetor($id);

    $setores->SetorID = '';
    $setores->Nome = '';
    $setores->Andar = '';
    $setores->Cor = '';
    $editar = false;
}

// listar setores
$listaSetores = $setores->exibirSetores();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Setores</title>
</head>

<body>

    <h1>Cadastro de Setores</h1>

    <p>
        <?php echo $mensagem; ?>
    </p>

    <h2>
        <?php echo $editar ? 'Editar Setor' : 'Cadastrar Setor'; ?>
    </h2>

    <form method="POST" action="index.php">

        <input
            type="hidden"
            name="SetorID"
            value="<?php echo $editar ? $setores->SetorID : ''; ?>"
        >

        <label>Nome:</label><br>
        <input
            type="text"
            name="Nome"
            required
            value="<?php echo htmlspecialchars($setores->Nome ?? ''); ?>"
        ><br><br>

        <label>Andar:</label><br>
        <input
            type="text"
            name="Andar"
            required
            value="<?php echo htmlspecialchars($setores->Andar ?? ''); ?>"
        ><br><br>

        <label>Cor:</label><br>
        <input
            type="text"
            name="Cor"
            required
            value="<?php echo htmlspecialchars($setores->Cor ?? ''); ?>"
        ><br><br>

        <button type="submit">
            <?php echo $editar ? 'Atualizar' : 'Cadastrar'; ?>
        </button>

        <?php if ($editar) { ?>
            <a href="index.php">Cancelar</a>
        <?php } ?>

    </form>

    <hr>

    <h2>Lista de Setores</h2>

    <?php if (is_array($listaSetores) && count($listaSetores) > 0) { ?>

        <table borde ="1" cellpadding = "8">

            <tr>
                <th>SetorID</th>
                <th>Nome</th>
                <th>Andar</th>
                <th>Cor</th>
                <th>Acoes</th>
            </tr>

            <?php foreach ($listaSetores as $setor) { ?>

                <tr>
                    <td>
                        <?php echo htmlspecialchars($setor['SetorID']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($setor['Nome']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($setor['Andar']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($setor['Cor']); ?>
                    </td>

                    <td>
                        <a href="index.php?editar=<?php echo $setor['SetorID']; ?>">
                            Editar
                        </a>

                        |

                        <a
                            href="index.php?excluir=<?php echo $setor['SetorID']; ?>"
                            onclick="return confirm('Deseja realmente excluir este setor?')"
                        >
                            Excluir
                        </a>
                    </td>
                </tr>

            <?php } ?>

        </table>

    <?php } else { ?>

        <p>Nenhum setor cadastrado.</p>

    <?php } ?>

</body>
</html>

