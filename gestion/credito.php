<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Ferreteria Rozzo</title>
    <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
    <link rel="stylesheet" type="text/css" href="../css/colors.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/tablaProdProv.css">
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
            echo "<h2>Tabla de Credito</h2>";
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
    <div id="busqueda">
    <form>
        <h3>Busqueda de Clientes</h3>
        <label for='clientes'>DNI/CUIL:</label>  
        <input id='inputBusqueda' placeholder='DNI/CUIL' type='number' size='35' onkeyup='showResult(this.value)'>
        <div id='livesearch'></div>
    </form>
    <div id='txtHint'><b>Datos del cliente aqui...</b></div>
    </div>
    <footer>
        <div id='regresoFoot'>
            <a href='../index.php' class='vuelta'>HOME</a>
            <a href='../index.php' class='vuelta'>Volver</a>
        </div>
        <div id='marcaDagua'>
            <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
        </div>
    </footer>
</body>
</html>

<script>
function showResult(str) {
    var nombre = document.getElementById('inputBusqueda').value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200 ) {
        document.getElementById('txtHint').innerHTML = this.responseText;
    }
    };
    xmlhttp.open('GET','livesearchcredito.php?q='+nombre,true);
    xmlhttp.send();
}
</script>