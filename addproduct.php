<?php
session_start();
require_once "Database/conexion.php";
include "Database/Database.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.');</script>";
    header("Refresh:0 , url=index.html");
}
$username = $_SESSION['username'];
$sql_fetch_todos = $consulta_addproduct;
$query = mysqli_query($conn, $sql_fetch_todos);
?>

<!doctype html>
<html lang="es">

<head>
    <title>Agregar Producto</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/Logo_CerroNavia.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/addproduct.css">
</head>

<body>
    <div class="header">
        <img  class="logo" src="img/Logo_CerroNavia.png" alt="Logo Cerro Navia">
        <h3>Municipalidad de Cerro Navia | Hola <?php echo $str = strtoupper($username) ?></h3>
        <a name="" id="" class="button-logout" href="logout.php" role="button">Cerrar Sesión</a>
    </div>
    <div class="content">
        <div class="container">
            <h1>Agregar Producto</h1>
        </div>
        <div class="addproduct">
            <form action="main/addproduct.php" method="POST">

                <label for="marca">Marca:</label>
                <br>
                <input type="text" name="marca" placeholder="Marca del equipo" required />

                <br>

                <label for="modelo">Modelo:</label>
                <br>
                <input type="text" name="modelo" placeholder="Modelo del equipo" required />

                <br>

                <label for="procesador">Procesador:</label>
                <br>
                <input type="text" name="procesador" placeholder="Procesador del equipo" required />

                <br>

                <input type="submit" style="float:right" value="Agregar Producto">
                <a class="returnregist" href="list.php" role="button" style="float:left">Volver</a>

            </form>
        </div>
        <div class="table-product">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">N°</th>
                    <th scope="col" hidden>ID_EQUIPO</th>
                    <th scope="col">MARCA</th>
                    <th scope="col">MODELO</th>
                    <th scope="col">PROCESADOR</th>
                    <th scope="col">EDITAR</th>
                    <th scope="col">ELIMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idpro = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td scope="row"><?php echo $idpro ?></td>
                            <td hidden><?php echo $row['id'] ?></td>
                            <td><?php echo $row['marca'] ?></td>
                            <td><?php echo $row['modelo'] ?></td>
                            <td><?php echo $row['procesador'] ?></td>
                            <td class="modify"><a name="edit" id="" class="bfix" href="fixproduct.php?id=<?php echo $row['id'] ?>&marca=<?php echo $row['marca'] ?>&modelo=<?php echo $row['modelo'] ?>&procesador=<?php echo $row['procesador']; ?> " role="button">
                            Editar
                            </a></td>
                            <td class="delete"><a name="id" id="" class="bdelete" href="main/deleteproduct.php?id=<?php echo $row['id'] ?>" role="button">
                            Eliminar
                            </a></td>
                        </tr>
                    <?php
                        $idpro++;
                    } ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>
    <?php
    mysqli_close($conn);
    ?>
</body>

</html>