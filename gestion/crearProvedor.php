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
	<title>Crear provedor</title>
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
        echo "<h2>Crear proveedor</h2>";
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
        <form id="loginform" action="validarProvedor.php" method="POST">
        <label for="Nombre">Nombre</label><input required type="text" name="nombre" placeholder="ingrese su Nombre">
          <button  class="buttom" type="submit">Enviar</button>
		    </form>
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