<?php
include('conexion.php');

$id = $_POST['idProducto'];
$imagen = $_POST['imagen'];

$sql = "DELETE FROM productos WHERE id = '".$id."'";
$resultado = mysqli_query($conexion, $sql);
unlink($imagen);
echo'<script type="text/javascript">
alert("Eliminado CORRECTAMENTE");
window.location.href="productos.php";
</script>';

?>