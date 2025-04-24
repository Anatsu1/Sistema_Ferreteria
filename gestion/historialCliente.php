<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial / Credito</title>
    <link rel="icon" type="image/x-icon" href="imagenes/iconos/ferreteria.ico">
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
            echo "<h2>Tabla de Historial</h2>";
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
        <?php
        include('conexion.php');

        $dni = $_POST['dni'];

        $sql = "SELECT * FROM historial WHERE cliente = '".$dni."'";
        $resultado = mysqli_query($conexion,$sql);
        echo "<div id='tablaHistorialCredito'>";
        if (mysqli_num_rows($resultado)> 0) {
        while ($datosHistorial = mysqli_fetch_assoc($resultado)) {
                echo "<div class='boxGrid boxHed boxTitle'>Compra del dia: ".$datosHistorial['fecha']."</div>";
                echo "<div class='boxGrid boxHed'>ID Producto</div>";
                echo "<div class='boxGrid boxHed'>Cantidad</div>";
                echo "<div class='boxGrid boxHed'>Nombre</div>";
                echo "<div class='boxGrid boxHed'>Valor actual</div>";
                echo "<div class='boxGrid boxHed'>Valor el dia de la compra</div>";

                $compra = unserialize($datosHistorial['datos']);
                $limite = sizeof($compra);

                for ($i=0; $i < $limite ; $i++) { 
                    $consultaNombre = "SELECT * FROM PRODUCTOS WHERE id = ".$compra[$i]['id'];
                    $resultadoSelect = mysqli_query($conexion,$consultaNombre);
                    echo "<div class='boxGrid'>".$compra[$i]['id']."</div>";
                    echo "<div class='boxGrid'>".$compra[$i]['cantidad']."</div>";
                    if (mysqli_num_rows($resultadoSelect)>0) {
                        $arreglo = mysqli_fetch_assoc($resultadoSelect);
                        echo "<div class='boxGrid'>".$arreglo['nombre']."</div>";
                        echo "<div class='boxGrid'>".$arreglo['valor']."</div>";
                    } else {
                        echo "<div class='boxGrid'>este producto ya no esta en la Base de Datos</div>";
                    }
                    echo "<div class='boxGrid'>".$compra[$i]['valor']."</div>";
                }
            }
            echo "</div>";
        } else {
            echo "<div>sin compras</div>";
        }

        ?>
    </section>
    <footer>
    <div id='regresoFoot'>
                <a href='../index.php' class='vuelta'>HOME</a>
                <a href='../gestion/credito.php' class='vuelta'>Volver</a>
            </div>
            <div id='marcaDagua'>
                <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
            </div>
     </footer>
</body>
</html>
