<?php
    session_start();
    require_once "../Database/conexion.php";
    include "../Database/Database.php";
    if($_SESSION['username'] == null){
    echo "<script>alert('Please login.')</script>";
    header("Refresh:0 , url = ../index.html");
    exit();
    }

    if($_POST['id'] != null && $_POST['marca'] != null && $_POST['modelo'] != null && $_POST['procesador'] != null){

        // Recibimos los valores del formulario y los limpiamos
        $id = trim($_POST['id']);
        $marca = trim($_POST['marca']);
        $modelo = trim($_POST['modelo']);
        $procesador = trim($_POST['procesador']);

        // Convertimos la marca a slug y nombre para comparar en la base de datos
        $marca_slug = strtolower($marca);
        $marca_nombre = strtoupper($marca);

        // Convertimos el modelo a slug y nombre para comparar en la base de datos
        $modelo_slug = strtolower($modelo);
        $modelo_nombre = strtoupper($modelo);

        // Convertimos el procesador a slug y nombre para comparar en la base de datos
        $procesador_slug = strtolower($procesador);
        $procesador_nombre = strtoupper($procesador);

        // Verificamos si la marca ya existe en la base de datos
        $query = "SELECT id FROM marca WHERE slug = '$marca_slug' AND nombre = '$marca_nombre'";
        $result = $conn->query($query);
        if ($result->num_rows == 0) {
            // La marca no existe, la agregamos a la tabla de marcas
            $query = "INSERT INTO marca (slug, nombre) VALUES ('$marca_slug', '$marca_nombre')";
            if (!$conn->query($query)) {
                echo "<script>alert('Error: No se pudo agregar la marca')</script>";
                header("Refresh:0 , url = ../addproduct.php");
                die("Error: No se pudo agregar la marca");
            }
            $marca_id = $conn->insert_id; // Obtenemos el ID de la marca recién insertada
        } else {
            // La marca ya existe, obtenemos su ID
            $row = $result->fetch_assoc();
            $marca_id = $row['id'];
        }

        // Verificamos si el modelo ya existe en la base de datos
        $query = "SELECT id FROM modelo WHERE slug = '$modelo_slug' AND nombre = '$modelo_nombre' AND marca_id = '$marca_id'";
        $result = $conn->query($query);
        if ($result->num_rows == 0) {
            // El modelo no existe, la agregamos a la tabla de modelos
            $query = "INSERT INTO modelo (slug, nombre, marca_id) VALUES ('$modelo_slug', '$modelo_nombre', '$marca_id')";
            if (!$conn->query($query)) {
                echo "<script>alert('Error: No se pudo agregar el modelo')</script>";
                header("Refresh:0 , url = ../addproduct.php");
                die("Error: No se pudo agregar el modelo");
            }
            $modelo_id = $conn->insert_id; // Obtenemos el ID del modelo recién insertada
        } else {
            // El modelo ya existe, obtenemos su ID
            $row = $result->fetch_assoc();
            $modelo_id = $row['id'];
        }

        // Verificamos si el procesador ya existe en la base de datos
        $query = "SELECT id FROM procesador WHERE slug = '$procesador_slug' AND nombre = '$procesador_nombre' AND modelo_id = '$modelo_id' AND marca_id = '$marca_id'";
        $result = $conn->query($query);
        if ($result->num_rows == 0) {
            // El procesador no existe, la agregamos a la tabla de procesadores
            $query = "UPDATE procesador
            SET slug = '$procesador_slug', nombre = '$procesador_nombre', modelo_id = '$modelo_id', marca_id = '$marca_id'
            WHERE id = '$id'";
            
            if (!$conn->query($query)) {
                echo "<script>alert('Error: No se pudo agregar el procesador')</script>";
                header("Refresh:0 , url = ../addproduct.php");
                die("Error: No se pudo agregar la marca");
            }
            mysqli_query($conn, $query);
            echo "<script>alert('Modificación exitosa')</script>";
            header("Refresh:0 , url = ../addproduct.php");
        } else {
            echo "<script>alert('ERROR: El producto que tratas de registrar ya existe')</script>";
            header("Refresh:0 , url = ../addproduct.php");
            die("ERROR: El producto que tratas de registrar ya existe");
            // La marca ya existe, obtenemos su ID
        }

    }

    // Cerramos la conexión a la base de datos
    $conn->close();

    // Redirigimos al usuario a la lista de productos
    header("Refresh:0 , url = ../addproduct.php");
    exit();

?>