<?php
    include("conexion.php");

    if(!$conexion)
    {
        echo 'Error en la conexion';
    }
    else
    {
        echo 'Conectado a la base de datos <br>';
    }

    $nombre= mysqli_real_escape_string($conexion, $_POST['nombre']);
    $contra= mysqli_real_escape_string($conexion, $_POST['contra']);
    $dni= mysqli_real_escape_string($conexion, $_POST['dni']);
    $estado= mysqli_real_escape_string($conexion, $_POST['estado']);


    if($nombre == 'admin')
    {
        $estado = 'administrador';
    }
      
    $sql_verify = "SELECT nombre FROM usuarios WHERE nombre = '$nombre'";
    $querys = mysqli_query($conexion,$sql_verify);
    if (mysqli_num_rows($querys) == 0){
        $sql_insert = "INSERT INTO usuarios (nombre,dni,contra,estado)
        VALUES ('$nombre','$dni','$contra','$estado');";
        $query= mysqli_query($conexion,$sql_insert);
        header('Location:iniciarSesion.php');
    }
    else{
        echo'<script type="text/javascript">
        alert("NOMBRE REGISTRADO, INGRESE OTRO");
        window.location.href="provedores.php";
        </script>';
    }
?>