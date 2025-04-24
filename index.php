<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Ferreteria Rozzo</title>
    <link rel="icon" type="image/x-icon" href="imagenes/iconos/ferreteria.ico">
    <link rel="stylesheet" type="text/css" href="css/colors.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>
<body>
    <header>
    <div id="usuario">
    <?php
    session_start();
    include("gestion/conexion.php");
    if(empty($_SESSION["usuario"])){
        header("Location: gestion/iniciarSesion.php");
    }
    else{
        echo "<h2>Bienvenido ".$_SESSION["usuario"]."</h2>";
    }
    ?>  
    </div>
    <div id="botonera">
        <form action="gestion/ventas.php" method="post">
            <button class="boton" type="submit">Ventas</button>
        </form> <!--Ventas-->
        <form action="gestion/credito.php" method="post">
            <button class="boton" type="submit">Historial de compras / Credito</button>
        </form> <!--Credito-->
        <form action="gestion/productos.php" method="post">
            <button class="boton" type="submit">Ver Productos</button>
        </form> <!--Ver Productos-->
        <form action="gestion/provedores.php" method="post">
            <button class="boton" type="submit">Ver Provedores</button>
        </form> <!--Ver Provedores-->
    </div>
    </header>
    <!--Menu Navegacion-->


<footer>
    <div id="regresoFoot">
        <a href='gestion/cerrarSesion.php' class='vuelta'>Cerrar Sesion</a>
        <?php
        if (isset($_SESSION["usuario"]) && $_SESSION["estado"] == "administrador") {
            echo "<a href='gestion/gestionBD.php' class=''>Gestion EXCEL</a>";
        }
    ?>
    </div>
    <div id="marcaDagua">
        <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
    </div>
</footer>
</body>
</html>