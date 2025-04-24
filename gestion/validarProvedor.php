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
 
    $sql_verify = "SELECT nombre FROM provedor WHERE nombre = '".$nombre."'";
    $querys = mysqli_query($conexion,$sql_verify);
    if (mysqli_num_rows($querys) == 0){
        $sql_insert = "INSERT INTO provedor (nombre) VALUES ('".$nombre."');";
        $query= mysqli_query($conexion,$sql_insert);
        header('Location:provedores.php');
    }
    else{
        echo'<script type="text/javascript">
        alert("NOMBRE REGISTRADO, INGRESE OTRO");
        window.location.href="crearProvedore.php";
        </script>';
    }
?>