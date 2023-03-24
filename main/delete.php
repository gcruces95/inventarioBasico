<?php
session_start();
require_once "../Database/conexion.php";
if ($_SESSION['username'] == null) {
    echo "<script>alert('Favor ingresar con tus credenciales')</script>";
    header("Refresh:0 , url = ../index.html");
    exit();
}

// Eliminar registro correspondiente
$delete_num = $_GET['id'];
$sql_delete =  "DELETE FROM product WHERE id = '$delete_num'";
$query_delete = mysqli_query($conn, $sql_delete);

if(!$query_delete) {
    echo "<script>alert('Error al eliminar el producto: ". mysqli_error($conn) ."')</script>";
    header("Refresh: 0 , url = ../list.php");
    exit();
} else {
    echo "<script>alert('Eliminación de Producto Exitosa')</script>";
    header("Refresh: 0 , url = ../list.php");
    exit();
}
mysqli_close($conn);
?>