<?php
include('conexion.php');

$id = $_POST['id'];
$codigo= mysqli_real_escape_string($conexion, $_POST['codigo']);
$nombre= mysqli_real_escape_string($conexion, $_POST['nombre']);
$tipo= mysqli_real_escape_string($conexion, $_POST['tipo']);
$valor= mysqli_real_escape_string($conexion, $_POST['valor']);
$multiplicador= mysqli_real_escape_string($conexion, $_POST['multiplicador']);
$cantidad= mysqli_real_escape_string($conexion, $_POST['cantidad']);
$cantidadMinima= mysqli_real_escape_string($conexion, $_POST['cantidadMinima']);
$divisible= mysqli_real_escape_string($conexion, $_POST['divisible']);
$provedor= mysqli_real_escape_string($conexion, $_POST['provedor']);
$observaciones= mysqli_real_escape_string($conexion, $_POST['obs']);

$sql_verify = "SELECT * FROM productos WHERE nombre = '$nombre'";
$querys = mysqli_query($conexion,$sql_verify);
$fila = mysqli_fetch_assoc($querys);
echo $fila["id"];
if (mysqli_num_rows($querys) == 0 or $fila['id'] == $id){
    $tipoDeImagen = strtolower(pathinfo($imagen,PATHINFO_EXTENSION));
    rename($imagen,'imgSubida/'.$nombre.'.'.$tipoDeImagen);
    $consulta = "UPDATE productos SET codigoProducto= '".$codigo."',nombre= '".$nombre."', valor= '".$valor."', cantidad= '".$cantidad."', divisible= '".$divisible."' ,
    imagen= '".'imgSubida/'.$nombre.'.'.$tipoDeImagen."', provedor= '".$provedor."', multiplicador= '".$multiplicador."' , cantidadMinima= '".$cantidadMinima."' , tipo= '".$tipo."', obs= '".$observaciones."' WHERE id= ".$id."";
    $resultado = mysqli_query($conexion,$consulta);
    echo'<script type="text/javascript">
    alert("MODIFICADO CORRECTAMENTE");
    window.location.href="productos.php";
    </script>';
}
else{
    echo'<script type="text/javascript">
    alert("NOMBRE REGISTRADO, INGRESE OTRO");
    window.location.href="modificarProducto.php?id='.$id.'";
    </script>';
}

?>