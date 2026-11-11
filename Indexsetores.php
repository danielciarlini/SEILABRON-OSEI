
<?php
include_once 'setores.php';

$objSetores = new Setores();
$resultado = $objSetores->exibirSetores();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Setores</title>
</head>

<body>

    <h1>Lista de Setores</h1>

    <table border="1">

        <tr>
            <th>SetorID</th>
            <th>Nome</th>
            <th>Andar</th>
            <th>Cor</th>
            <th>Acoes</th>
        </tr>

        <?php
        if (is_array($resultado)) {
            foreach ($resultado as $setor) {
        ?>

                <tr>
                    <td><?php echo $setor['SetorID']; ?></td>
                    <td><?php echo $setor['Nome']; ?></td>
                    <td><?php echo $setor['Andar']; ?></td>
                    <td><?php echo $setor['Cor']; ?></td>

                    <td>
                        <a href="#">Visualizar</a> -
                        <a href="#">Excluir</a> -
                        <a href="#">Editar</a>
                    </td>
                </tr>

        <?php
            }
        } else {
        ?>

            <tr>
                <td colspan="5">Nenhum setor cadastrado.</td>
            </tr>

        <?php
        }
        ?>

    </table>

</body>
</html>
