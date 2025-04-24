<?php
include("conexion.php");
$nom_usuario = mysqli_real_escape_string($conexion,$_POST["usuario"]);
$contra = mysqli_real_escape_string($conexion,$_POST["password"]);
$consulta = "SELECT * FROM usuarios WHERE nombre='$nom_usuario' and contra='$contra'";
$resultado = mysqli_query($conexion,$consulta);
$filas=mysqli_num_rows($resultado);
if($filas){
    $fila=mysqli_fetch_assoc($resultado);
    session_start();
    $id = $fila['idUsuario'];
    $_SESSION['idUsuario'] = $id;
    $_SESSION['usuario'] = $fila['nombre'];
    $_SESSION['estado'] = $fila['estado'];
    header("location:../index.php");
}
else{
    echo'<script type="text/javascript">
    alert("Valores invalidos, intente nuevamente.");
    window.location.href="iniciarSesion.php";
    </script>';
}
?>