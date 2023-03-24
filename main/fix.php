<?php
session_start();
require_once "../Database/conexion.php";
if($_SESSION['username'] == null){
    echo "<script>alert('Please login.')</script>";
    header("Refresh:0 , url = ../index.html");
    exit();
}

if($_POST['id'] != null && $_POST['nombre'] != null && $_POST['marca'] != null && $_POST['modelo'] != null && 
$_POST['procesador'] != null && $_POST['direccion'] != null && $_POST['departamento'] != null && 
$_POST['usuario'] != null && $_POST['ubicacion'] != null){

    // Convertimos los datos a myúsculas para comparar en la base de datos
    $id = strtoupper(trim($_POST['id']));
    $nombre = strtoupper(trim($_POST['nombre']));
    $marca = strtoupper(trim($_POST['marca']));
    $modelo = strtoupper(trim($_POST['modelo']));
    $procesador = strtoupper(trim($_POST['procesador']));
    $direccion = strtoupper(trim($_POST['direccion']));
    $departamento = strtoupper(trim($_POST['departamento']));
    $usuario = strtoupper(trim($_POST['usuario']));
    $ubicacion = strtoupper(trim($_POST['ubicacion']));

    // Verificamos si el registro ya existe en la base de datos
    $query = "SELECT product.id, marca.nombre, modelo.nombre, procesador.nombre, direccion.nombre, departamento.nombre, product.usuario, product.ubicacion
    FROM product
    INNER JOIN marca ON product.marca = marca.id
    INNER JOIN modelo ON product.modelo = modelo.id
    INNER JOIN procesador ON product.procesador = procesador.id
    INNER JOIN direccion ON product.direccion = direccion.id
    INNER JOIN departamento ON product.departamento = departamento.id
    WHERE product.nombre = '$nombre' 
    AND marca.nombre = '$marca' 
    AND modelo.nombre = '$modelo' 
    AND procesador.nombre = '$procesador' 
    AND direccion.nombre = '$direccion' 
    AND departamento.nombre = '$departamento' 
    AND product.usuario = '$usuario' 
    AND product.ubicacion = '$ubicacion'";
    $result = $conn->query($query);
    if ($result->num_rows == 0) {
        // Si el registro no existe, la agregamos a la tabla product
        $query = "UPDATE product 
                SET 
                nombre = '$nombre', 
                marca = '$marca', 
                modelo = '$modelo', 
                procesador = '$procesador', 
                direccion = '$direccion', 
                departamento = '$departamento', 
                usuario = '$usuario', 
                ubicacion = '$ubicacion'
                WHERE 
                id = '$id'";
        if (!$conn->query($query)) {
            echo "<script>alert('Error: No se pudo modificar el registro')</script>";
            header("Refresh:0 , url = ../addlist.php");
            die("Error: No se pudo agregar la marca");
        }
        mysqli_query($conn, $query);
        echo "<script>alert('Modificación exitosa')</script>";
        header("Refresh:0 , url = ../addlist.php");
    } else {
        // La marca ya existe, obtenemos su ID
        echo "<script>alert('ERROR: El producto que tratas de registrar ya existe')</script>";
        header("Refresh:0 , url = ../addlist.php");
        die("ERROR: El producto que tratas de registrar ya existe");
    }
}

// Cerramos la conexión a la base de datos
$conn->close();

// Redirigimos al usuario a la lista de productos
header("Refresh:0 , url = ../addlist.php");
exit();

?>