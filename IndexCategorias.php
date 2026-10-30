<?php
include_once 'categorias.php';

$objCategorias = new Categorias();
$resultado = $objCategorias -> exibirCategorias();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>CategoriaID</th>
            <th>Nome</th>
            <th>Descrição</th>
        </tr>
        <?php foreach ($resultado as $categoria) { ?>
            <tr>
                <td><?php echo $categoria['CategoriaID']; ?></td>
                <td><?php echo $categoria['Nome']; ?></td>
                <td><?php echo $categoria['Descricao']; ?></td>
                <td>
                    <a href="#">Visualizar</a> - <a href="#">Excluir</a> - <a href="#">Editar</a>
                </td>
            </tr>
        <?php 
        } 
        ?>
    </table>
</body>
</html>