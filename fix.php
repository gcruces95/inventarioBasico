<?php
session_start();
require_once "Database/conexion.php";
include "Database/Database.php";
$user_conn = new MyDatabase($conn);
$sql_fetch_todos = $consulta_addregistro;
$query = mysqli_query($conn, $sql_fetch_todos);

if ($_SESSION['username'] == null) {
    echo "<script>alert('Please login.');</script>";
    header("Refresh:0 , url=index.html");
}

?>

<!doctype html>
<html lang="es">

<head>
    <title>Agregar registro</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/Logo_CerroNavia.png">
    <link href="https://fonts.googleapis.com/css2?family=Mitr&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="styles/addlist.css">
</head>

<body>
    <div class="header">
        <img  class="logo" src="img/Logo_CerroNavia.png" alt="Logo Cerro Navia">
        <h3>Municipalidad de Cerro Navia | Hola <?php echo $str = strtoupper($_SESSION['username']) ?></h3>
        <a name="" id="" class="button-logout" href="logout.php" role="button">Cerrar Sesión</a>
    </div>
    <div class="content">
        <div class="container">
            <h1>EDITAR REGISTRO</h1>
        </div>
        <div class="addproduct">
            <form action="main/fix.php" method="POST">

                <input type="hidden" value="<?php echo $_GET['id'] ?>" name="id" />

                <label for="nombre">NOMBRE EQUIPO:</label><br>
                <input type="text" name="nombre" placeholder="Nombre del equipo" value="<?php echo $_GET['nombre']?>" required /><br>
                
                <label for="marca">MARCA</label><br>
                <select name="marca" id="marca" class="form-control">
                    <option value="" selected>Seleccione una marca</option>
                    <?php $marca=$user_conn->buscar("marca","1");?>
                    <?php foreach($marca as $marca): ?>
                    <option value="<?php echo $marca['id'] ?>"><?php echo $marca['nombre'] ?></option>
                    <?php endforeach;?>
                </select><br>
                
                <label for="modelo">MODELO</label><br>
                <select name="modelo" id="modelo"><option value="" selected>Seleccione un modelo</option></select><br>
                
                <label for="procesador">PROCESADOR</label><br>
                <select name="procesador" id="procesador"><option value="" selected>Seleccione un procesador</option></select><br>

                <label for="direccion">DIRECCIÓN</label><br>
                <select name="direccion" id="direccion" class="form-control">
                    <option value="" selected>Seleccione una Dirección</option>
                    <?php $direccion=$user_conn->buscar("direccion","1");?>
                    <?php foreach($direccion as $direccion): ?>
                    <option value="<?php echo $direccion['id'] ?>"><?php echo $direccion['nombre'] ?></option>
                    <?php endforeach;?>
                </select><br>

                <label for="departamento">DEPARTAMENTO</label><br>
                <select name="departamento" id="departamento"><option value="" selected>Seleccione un Departamento</option></select><br>

                <label for="usuario">USUARIO:</label><br>
                <input type="text" name="usuario" placeholder="Usuario del equipo" value="<?php echo $_GET['usuario']?>" required />

                <br>

                <label for="ubicacion">UBICACIÓN:</label><br>
                <input type="text" name="ubicacion" placeholder="Ubicación del equipo" value="<?php echo $_GET['ubicacion']?>" required />

                <br>

                <input type="submit" style="float:right" value="Agregar">
                <a class="returnregist" href="list.php" role="button" style="float:left">Volver</a>

            </form>
        </div>
        <div class="table-product">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">N°</th>
                    <th scope="col">ID</th>
                    <th scope="col">NOMBRE EQUIPO</th>
                    <th scope="col">MARCA</th>
                    <th scope="col">MODELO</th>
                    <th scope="col">PROCESADOR</th>
                    <th scope="col">DIRECCIÓN</th>
                    <th scope="col">DEPARTAMENTO</th>
                    <th scope="col">USUARIO</th>
                    <th scope="col">UBICACIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idpro = 1;
                    while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td scope="row"><?php echo $idpro ?></td>
                            <td><?php echo $row['id'] ?></td>
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
    <script>
$("#marca").change(function(){    	
    $.ajax({
        data:  "id="+$("#marca").val(),
        url:   'ajax_modelos.php',
        type:  'post',
        dataType: 'json',
        beforeSend: function () {  },
        success:  function (response) {            
            var html = "";
            html+= '<option value="">Seleccione un modelo</option>';
            $.each(response, function( index, value ) {
                html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
            });  
            $("#modelo").html(html);
        },
        error:function(){
            alert("error")
        }
    });
})
$("#modelo").change(function(){    	
	$.ajax({
        data:  "id="+$("#modelo").val(),
        url:   'ajax_procesadores.php',
        type:  'post',
        dataType: 'json',
        beforeSend: function () {  },
        success:  function (response) {            
            var html = "";
            html+= '<option value="">Seleccione un procesador</option>';
            $.each(response, function( index, value ) {
                html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
            });  
            $("#procesador").html(html);
        },
        error:function(){
            alert("error")
        }
    });
})
$("#direccion").change(function(){    	
    $.ajax({
        data:  "id="+$("#direccion").val(),
        url:   'ajax_departamentos.php',
        type:  'post',
        dataType: 'json',
        beforeSend: function () {  },
        success:  function (response) {            
            var html = "";
            html+= '<option value="">Seleccione un modelo</option>';
            $.each(response, function( index, value ) {
                html+= '<option value="'+value.id+'">'+value.nombre+"</option>";
            });  
            $("#departamento").html(html);
        },
        error:function(){
            alert("error")
        }
    });
})
</script>

</body>
</html>