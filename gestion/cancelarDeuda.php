<?php
include('conexion.php');
$id = $_POST['dni'];

$sql = "UPDATE clientes SET credito = 0 WHERE dniCuil = '".$id."'";

mysqli_query($conexion, $sql);

echo '<script type="text/javascript">
alert("Cancelada la deuda del cliente con CUIL: '.$id.'");
window.location.href="credito.php";
</script>';

?>