<?php
session_start();
require_once "Database/conexion.php";
include "Database/Database.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.');</script>";
    header("Refresh:0 , url=index.html");
    exit();
}
$username = $_SESSION['username'];
$sql_fetch_todos = $consulta_addregistro;
$query = mysqli_query($conn, $sql_fetch_todos);

?>

<!doctype html>
<html lang="es">
<head>
    <title>Registro de productos</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/Logo_CerroNavia.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/list.css">
</head>
<body>
    <div class="header">
        <img  class="logo" src="img/Logo_CerroNavia.png" alt="Logo Cerro Navia">
        <h3>Municipalidad de Cerro Navia | Hola <?php echo $str = strtoupper($username) ?></h3>
        <a name="" id="" class="button-logout" href="logout.php" role="button">Cerrar Sesión</a>
    </div>
    <div class="content">
        <div class="container">
            <h1>Registro de productos</h1>
        </div>
        <a class="Addproduct" style="float:left" href="addproduct.php" role="button">PRODUCTOS</a>
        <a class="Addlist" style="float:right" href="addlist.php" role="button">AGREGAR</a>

        <div class="table-product">
            <table>
                <tr>
                    <th scope="col">N°</th>
                    <th scope="col" hidden>ID</th>
                    <th scope="col">NOMBRE EQUIPO</th>
                    <th scope="col">MARCA</th>
                    <th scope="col">MODELO</th>
                    <th scope="col">PROCESADOR</th>
                    <th scope="col">DIRECCIÓN</th>
                    <th scope="col">DEPARTAMENTO</th>
                    <th scope="col">USUARIO</th>
                    <th scope="col">UBICACIÓN</th>
                </tr>
                <tbody>
                    <?php
                    $idpro = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td scope="row"><?php echo $idpro ?></td>
                            <td hidden><?php echo $row['id'] ?></td>
                            <td><?php echo $row['nombre'] ?></td>
                            <td><?php echo $row['marca'] ?></td>
                            <td><?php echo $row['modelo'] ?></td>
                            <td><?php echo $row['procesador'] ?></td>
                            <td><?php echo $row['direccion'] ?></td>
                            <td><?php echo $row['departamento'] ?></td>
                            <td><?php echo $row['usuario'] ?></td>
                            <td><?php echo $row['ubicacion'] ?></td>
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