<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/colors.css">
  <link rel="stylesheet" type="text/css" href="../css/tablaProdProv.css">
  <link rel="stylesheet" type="text/css" href="../css/index.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
    <title>Tabla Proveedores</title>
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
        echo "<h2>Tabla proveedores</h2>";
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
    <section id="contenedor">
      <div id="tablaProveedor">
      <div class='boxGrid boxHed'>ID</div>
      <div class='boxGrid boxHed'>Nombre</div>
      <div class='boxGrid boxHed boxFunc'>Funciones</div>
        <?php
        include("conexion.php");
        //consulta de productos
        $sql = "SELECT * FROM provedor";
        $resultado = mysqli_query($conexion, $sql);
        
        //impresion de productos
        if (mysqli_num_rows($resultado) > 0) { 
            // output de datos
            while($fila = mysqli_fetch_assoc($resultado)) {
              echo 
               "<div class='boxGrid'>" . $fila["id"]. "</div>".
               "<div class='boxGrid'>" . $fila["nombre"]."</div>" .
               "<div class='boxGrid'><form action='modificarProvedor.php' method='POST'>
                    <input hidden type='number' name='idP' value='".$fila["id"]."'>
                    <button class='buttom' type='submit'>Modificar provedor</button>
                </form></div>
                <div class='boxGrid'><form action='borrarProvedor.php' method='POST'>
                    <input hidden type='number' name='idP' value='".$fila["id"]."'>
                    <button class='buttom' type='submit'>Borrar Provedor</button>
                </form></div>";
            }
          } else {
            echo "Sin resultados";
          }
          
        mysqli_close($conexion);
        ?>
      </div>
    </section>
  <footer>
    <div id="regresoFoot">
        <a href='../index.php' class='vuelta'>HOME</a>
        <a class="funcion" href='crearProvedor.php'>Crear Provedor</a>
    </div>
    <div id="marcaDagua">
        <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
    </div>
</footer>
</body>        
</html>