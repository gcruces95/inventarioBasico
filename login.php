<?php
    require_once "Database/conexion.php";
    if(trim($_POST['username'])== null || trim($_POST['password']) == null){
        echo "<script>alert('ERROR: Por favor complete los campos solicitados')</script>";
        header("Refresh:0 , url =  index.html");
        exit();
    }
    else{
        require_once "Database/conexion.php";
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $password = mysqli_real_escape_string($conn,md5($_POST['password']));
        $sql = "SELECT username, password FROM user WHERE username ='". $username ."' and password = '".$password."'";
        $query = mysqli_query($conn,$sql);
        $result = mysqli_fetch_array($query , MYSQLI_ASSOC);
        if(!$result){
            echo "<script>alert('ERROR: Usuario o Contraseña Inválida')</script>";
            header("Refresh:0 , url = logout.php");
            exit();

        }
        else{
            session_start();
            $_SESSION['username'] = $result['username'];
            header("Location: list.php");
            session_write_close();
        }
    }
    mysqli_close($conn);
?>