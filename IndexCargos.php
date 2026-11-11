
<?php
include_once 'Cargos.php';

$objCargos = new Cargos();
$resultado = $objCargos->exibirCargos();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cargos</title>
</head>

<body>

    <h1>Lista de Cargos</h1>

    <table border="1">
        <tr>
            <th>CargoID</th>
            <th>Nome</th>
            <th>Teto Salarial</th>
            <th>Acoes</th>
        </tr>

        <?php
        if (is_array($resultado)) {
            foreach ($resultado as $cargo) {
        ?>

                <tr>
                    <td><?php echo $cargo['CargoID']; ?></td>
                    <td><?php echo $cargo['Nome']; ?></td>
                    <td><?php echo $cargo['TetoSalarial']; ?></td>

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
                <td colspan="4">Nenhum cargo cadastrado.</td>
            </tr>

        <?php
        }
        ?>

    </table>

</body>
</html>
