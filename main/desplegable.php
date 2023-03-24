<?php
    session_start();
    require_once "../Database/Database.php";
    if($_SESSION['username'] == null){
        echo "<script>alert('Please login.')</script>";
        header("Refresh:0 , url = ../index.html");
        exit();
    }

    if($_POST['marca'] != null){
        $sql = "INSERT INTO equipo (marca,modelo,procesador) VALUES ('". trim($_POST['marca']). "','". trim($_POST['modelo']). "','". trim($_POST['procesador']). "')";
        if($conn->query($sql)){
            echo "<script>alert('Registrado correctamente')</script>";
            header("Refresh:0 , url = ../addproduct.php");
            exit();
        }
        else{
            echo "<script>alert('Error al registrar')</script>";
            header("Refresh:0 , url = ../addproduct.php");
            exit();
        }
    }
    else{
        echo "<script>alert('Complete la información solicitada')</script>";
        header("Refresh:0 , url = ../addproduct.php");
        exit();
    }
    $conn->close();
?>