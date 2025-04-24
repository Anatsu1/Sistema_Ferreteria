<?php
include('conexion.php');

$id = $_POST['idP'];

$sql = "DELETE FROM provedor WHERE id = '".$id."'";
$resultado = mysqli_query($conexion, $sql);

header("location: provedores.php"); //redireccion a tabla provedor

?>