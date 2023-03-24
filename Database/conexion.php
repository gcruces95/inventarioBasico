<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "project";
$conn = new mysqli($host , $user, $pass, $dbname);
mysqli_query($conn , "SET character_set_results=utf8");
if($conn->connect_error){
    die("Database Error : " . $conn->connect_error);
}

class MyDatabase {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function buscar($tabla, $condicion){
        $resultado = $this->conn->query("SELECT * FROM $tabla WHERE $condicion") or die($this->conn->error);
        if($resultado)
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;
    }

    public function buscarProcesador($tabla, $condicion_uno, $condicion_dos){
        $resultado = $this->conn->query("SELECT * FROM $tabla WHERE $condicion_uno AND $condicion_dos") or die($this->conn->error);
        if($resultado)
            return $resultado->fetch_all(MYSQLI_ASSOC);
        return false;
    }
}

//$myDB = new MyDatabase($conn);
//$resultado = $myDB->buscar("tabla1", "condicion1 = 1");
//$resultadoProcesador = $myDB->buscarProcesador("tabla2", "condicion1 = 1", "condicion2 = 2");