<?php
session_start();
require_once "Database/Database.php";

// Obtener todas las marcas sin duplicados
$sql_fetch_marcas = "SELECT DISTINCT marca FROM equipo";
$query_marcas = mysqli_query($conn, $sql_fetch_marcas);
var_dump($query_marcas);

// Si se ha seleccionado una marca, obtener todos los modelos de esa marca
if (isset($_POST['marca'])) {
    $marca_seleccionada = $_POST['marca'];
    $sql_fetch_modelos = "SELECT DISTINCT modelo FROM equipo WHERE marca='$marca_seleccionada'";
    $query_modelos = mysqli_query($conn, $sql_fetch_modelos);
    var_dump($query_modelos);
}
if (isset($_POST['marca']) && isset($_POST['modelo'])) {
    $marca_seleccionada = $_POST['marca'];
    $modelo_seleccionado = $_POST['modelo'];
    $sql_fetch_procesadores = "SELECT procesador FROM equipo WHERE marca = '$marca_seleccionada' AND modelo = '$modelo_seleccionado'";
    $query_procesadores = mysqli_query($conn, $sql_fetch_procesadores);
    var_dump($query_procesadores);
}

    mysqli_close($conn);
?>

<!doctype html>
<html lang="es">

<head>
    <title>Prueba de listas desplegables Agregar registro</title>
</head>

<body>
    <div class="content">
        <div class="addproduct">

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">

                <label for="marca">Marca:</label><br>
                <select id="marca" name="marca" onchange="this.form.submit()">
                    <option value="">Seleccionar marca</option>
                    <?php
                    while ($fila = $query_marcas->fetch_assoc()) {
                        $marca = $fila['marca'];
                        if (isset($_POST['marca']) && $_POST['marca'] == $marca) {
                            echo "<option value='$marca' selected>$marca</option>";
                        } else {
                            echo "<option value='$marca'>$marca</option>";
                        }
                    }
                    ?>
                </select><br>

                <label for="modelo">Modelo:</label><br>
                <select id="modelo" name="modelo">
                    <option value="">Seleccionar modelo</option>
                    <?php
                    if (isset($query_modelos)) {
                        while ($fila = $query_modelos->fetch_assoc()) {
                            $modelo = $fila['modelo'];
                            echo "<option value='$modelo'>$modelo</option>";
                        }
                    }
                    ?>
                </select><br>

                <label for="procesador">Procesador:</label><br>
                <select id="procesador" name="procesador">
                    <option value="">Seleccionar procesador</option>
                    <?php
                    if (isset($query_procesadores)) {
                        while ($fila = $query_procesadores->fetch_assoc()) {
                            $procesador = $fila['procesador'];
                            echo "<option value='$procesador'>$procesador</option>";
                        }
                    }
                    ?>
                </select><br>

                <input type="submit" style="float:right" value="Agregar">

            </form>
        </div>
    </div>

</body>
</html>