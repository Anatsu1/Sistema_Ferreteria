<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/colors.css">
  <link rel="stylesheet" type="text/css" href="../css/formulariosModCrear.css">
  <link rel="stylesheet" type="text/css" href="../css/index.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
  <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
	<title>Crear producto</title>
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
        echo "<h2>Crear producto</h2>";
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
    	<form id="loginform" action="validarProducto.php" method="POST" enctype="multipart/form-data">
        <label for="Codigo">Codigo Producto</label><input name='codigo' type='text' placeholder="Codigo Producto">
        <label for="Nombre">Nombre</label><input required name='nombre' type='text' placeholder="Nombre">
        <label for="Tipo">Tipo</label><input required name='tipo' type='text' placeholder="Tipo">
        <label for="Valor">Valor</label><input required name='valor' type='text' placeholder="Valor">
        <label for="Multiplicador">Multiplicador</label><input name='multiplicador' type='number' placeholder="Multiplicador">
        <label for="Cantidad">Cantidad</label><input required name='cantidad' type='number' placeholder="Cantidad">
        <label for="Cantidad Minima">Cantidad Minima</label><input required name='cantidadMinima' type='number' placeholder="Cantidad Minima">
        <label for='provedor'>Divisible: </label>
        <select name='divisible'>
            <option value='paquete'>paquete</option>
            <option value='unidad'>unidad</option>
        </select>
        <label for="Imagen">Imagen</label><input type="file" name="archivoAsubir" id="archivoAsubir">
        <label for="Proveedor">Proveedor</label><select name='provedor' id='selectorProvedor'>
        <?php 
        include('conexion.php');
        $consultaProvedores = "SELECT * FROM provedor";
        $resultadoProvedores = mysqli_query($conexion,$consultaProvedores);
        while ($provedores = mysqli_fetch_assoc($resultadoProvedores)) {
              echo "<option value='".$provedores['nombre']."'>".$provedores['nombre']."</option>";
            }
            echo "</select>";
        ?>
        <label for="Obs">Observaciones</label><input name='obs' type='textarea' placeholder="Observaciones">
        <input type="submit" class="buttom" value="ENVIAR">
	    </form>
     </div>
    </div>
  </div>

  <footer>
    <div id="regresoFoot">
        <a href='../index.php' class='vuelta'>HOME</a>
        <a class="funcion" href='productos.php'>Cancelar</a>
    </div>
    <div id="marcaDagua">
        <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
    </div>
</footer>
</body>
</html>