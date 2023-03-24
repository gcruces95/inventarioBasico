<?php 
if(isset($_POST['id'])):
	require_once "Database/conexion.php";
	$user_conn = new MyDatabase($conn);
	$u=$user_conn->buscar("procesador","modelo_id=".$_POST['id'],"marca_id=".$_POST['id']);
	$html=[];
	foreach ($u as $value)
		$html[] =   ["id"=>$value['id'] ,"nombre"=>$value['nombre'] ];
	die(json_encode($html));
endif;