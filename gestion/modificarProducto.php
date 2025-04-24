<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <title>Modificar Producto</title>
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
        echo "<h2>Modificar producto</h2>";
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

        $id = $_GET['id'];

        $sql = "SELECT * FROM productos WHERE id='".$id."'";
        $resultado = mysqli_query($conexion, $sql);
        $consultaProvedores = "SELECT * FROM provedor";
        $resultadoProvedores = mysqli_query($conexion,$consultaProvedores);
        //impresion de productos
        if (mysqli_num_rows($resultado) > 0) { 
            // output de datos
            while($fila = mysqli_fetch_assoc($resultado)) {
            echo 
            "<form id='loginform' action='guardarCambiosProducto.php' method='post'>".
                    "<input hidden type='number' name='id' value='".$fila["id"]."'>". //id de referencia
                    "<label for='Codigo'>Codigo Producto</label><input name='codigo' type='text' value='".$fila["codigoProducto"]."'>".
                    "<label for='Tipo'>Tipo</label><input required name='tipo' type='text' value='".$fila["tipo"]."'>".
                    "<label for='Nombre'>Nombre</label><input required name='nombre' type='text' value='".$fila["nombre"]."'>".
                    "<label for='Valor'>Valor</label><input required name='valor' type='text' value='".$fila["valor"]."'>".
                    "<label for='Multiplicador'>Multiplicador</label><input name='multiplicador' type='number' value='".$fila["multiplicador"]."'>".
                    "<label for='Cantidad'>Cantidad</label><input required name='cantidad' type='text' value='".$fila["cantidad"]."'>".
                    "<label for='Cantidad Minima'>Cantidad Minima</label><input required name='cantidadMinima' type='number' value='".$fila["cantidadMinima"]."'>".
                    "<input hidden name='imagen' type='text' value='".$fila["imagen"]."'>".
                
                //select provedores
                    "<label for='provedor'>Provedor: </label>";
                    echo "<select name='provedor' id='selectorProvedor'>";
                    while ($provedores = mysqli_fetch_assoc($resultadoProvedores)) {
                    echo "<option value='".$provedores['nombre']."'>".$provedores['nombre']."</option>";
                    }
                    echo "</select>";
                    echo "<label for='provedor'>Divisible: </label>
                        <select name='divisible'>
                        <option value='paquete'>paquete</option>
                        <option value='unidad'>unidad</option>
                        </select>";
                    echo "<label for='Obs'>Observaciones</label><input name='obs' type='textarea'  value='".$fila["obs"]."'>";
                    echo "<button class='buttom'type='submit'>Guardar Cambios</button>";
                    echo "<button class='buttom'><a href='productos.php' style='color:white;text-decoration:none;'>Atras</a></button>";
                    echo "</form>";
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
    </div>
    <div id="marcaDagua">
        <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
    </div>
</footer>
</body>
</html>
