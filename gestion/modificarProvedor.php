<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <title>Modificar productor</title>
  <link rel="stylesheet" type="text/css" href="../css/colors.css">
  <link rel="stylesheet" type="text/css" href="../css/formulariosModCrear.css">
  <link rel="stylesheet" type="text/css" href="../css/index.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
  <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
</head>
<body>
<header>
    <div id="usuario">
    <?php
    session_start();
    include("conexion.php");
    if(empty($_SESSION["usuario"])){
        header("Location: iniciarSesion.php");
    }
    else{
        echo "<h2>Modificar proveedor</h2>";
    }
    ?>  
    </div>
    <div id="botonera">
        <form action="ventas.php" method="post">
            <button class="boton" type="submit">Ventas</button>
        </form> <!--Ventas-->
        <form action="credito.php" method="post">
            <button class="boton" type="submit">Historial de compras / Credito</button>
        </form> <!--Credito-->
        <form action="productos.php" method="post">
            <button class="boton" type="submit">Ver Productos</button>
        </form> <!--Ver Productos-->
        <form action="provedores.php" method="post">
            <button class="boton" type="submit">Ver Provedores</button>
        </form> <!--Ver Provedores-->
    </div>
  </header>
  <div id="contenedor">
    <div id="central">
      <div id="formulario">
        <?php
        include('conexion.php');

        $idProvedor = $_POST['idP'];

        $sql = "SELECT * FROM provedor WHERE id='".$idProvedor."'";
        $resultado = mysqli_query($conexion, $sql);

        //impresion de productos
        if (mysqli_num_rows($resultado) > 0) { 
            // output de datos
            while($fila = mysqli_fetch_assoc($resultado)) {
            echo 
            "<form id='loginform' action='guardarCambiosProvedor.php' method='post'>".
                    "<input hidden type='number' name='id' value='".$fila["id"]."'>". //id de referencia
                    "<label for='Nombre'>Nombre</label><input required name='nombre' type='text' value='".$fila["nombre"]."'><br>".  
                    "<button type='submit' class='buttom'>Guardar Cambios</button>
                </form>";
            }
        } else {
            echo "Sin resultados";
        }
        
        mysqli_close($conexion);
        ?>
     </div>
    </div>
  </div>
  <footer>
    <div id="regresoFoot">
        <a href='../index.php' class='vuelta'>HOME</a>
        <a class="funcion" href='provedores.php'>Cancelar</a>
    </div>
    <div id="marcaDagua">
        <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
    </div>
</footer>
</body>
</html>
