<?php
include('conexion.php');

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$sql = "UPDATE provedor SET nombre='{$nombre}' WHERE id=" . $id;
if($conexion->query($sql) === TRUE){
        $result = mysqli_query($conexion,$sql);
        echo "<script>alert('Publicacion actualizada con exito');</script>";
}
else{
    echo "<script>alert('ERROR INTENTE DE NUEVO');</script>";
}

header("location: provedores.php");
//consulta para guardar cambios
?>