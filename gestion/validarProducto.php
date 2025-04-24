<?php
    include("conexion.php");
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
    

    $carpetaDestino = "imgSubida/";
    $id= $nombre; //definimos un nombre nuevo para el archivo
    $archivo = $carpetaDestino . basename($_FILES["archivoAsubir"]["name"]); //recibimos el archivo completo con nombre y extension para concatenarlo con la carpeta destino
    $subio = 1;
    $tipoDeImagen = strtolower(pathinfo($archivo,PATHINFO_EXTENSION)); //devuelve el tipo de extension del archivo
    
    //var_dump($carpetaDestino.$id.".".$tipoDeImagen); //ver la carpeta destino, el nuevo nombre y la extension del archivo.
    
    // Chequea si el archivo es una imagen
    if(isset($_POST["submit"])) {
      $check = getimagesize($_FILES["archivoAsubir"]["tmp_name"]);
      if($check !== false) {
        $subio = 1;
      } else {
        echo "El archivo no es una imagen.";
        $subio = 0;
      }
    }
    
    // Chequea si el archivo existe
    if (file_exists($archivo)) {
      echo "El archivo \"". htmlspecialchars( basename( $_FILES["archivoAsubir"]["name"]))."\"  ya existe";
      $subio = 0;
    }
    
    //si quisieramos guardar la url de la imagen para subirla a una BD, deberiamos usar $carpetaDestino.$id."."$tipoDeImagen , todas esta linea como tipo STRING
    $imagen = "$carpetaDestino"."$id"."."."$tipoDeImagen";

    $sql_verify = "SELECT nombre FROM productos WHERE nombre = '$nombre'";
    $querys = mysqli_query($conexion,$sql_verify);
    if (mysqli_num_rows($querys) == 0){
      if ($subio == 0) {
        echo ", no fue subido.";
      } else {
        if (move_uploaded_file($_FILES["archivoAsubir"]["tmp_name"], $carpetaDestino.$id.".".$tipoDeImagen)) { //movemos el archivo desde memoria a una carpeta destino, reescribimos su nombre, le agregamos "." y su extension al final
          echo "El archivo ". htmlspecialchars( basename( $_FILES["archivoAsubir"]["name"])). " fue subido como:  \"".$id.".".$tipoDeImagen."\""; //mensaje de subida con el nuevo nombre
        } else {
          echo "Hubo un error subiendo tu archivo.";
        }
      }
      $sql_insert = "INSERT INTO productos (codigoProducto,nombre,cantidad,cantidadMinima,divisible,imagen,valor,multiplicador,provedor,tipo,obs)
      VALUES ('$codigo','$nombre','$cantidad','$cantidadMinima','$divisible','$imagen','$valor','$multiplicador','$provedor','$tipo','$observaciones');";
      $query= mysqli_query($conexion,$sql_insert);
      header('Location:productos.php');
    }
    else{
      echo'<script type="text/javascript">
        alert("Producto existente ERROR, ingrese otro nombre");
        window.location.href="crearProducto.php";
        </script>';
    }
?>