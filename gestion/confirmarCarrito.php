<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
    <title>Confirmar Carrito</title>
    <link rel="icon" type="image/x-icon" href="imagenes/iconos/ferreteria.ico">
    <link rel="stylesheet" type="text/css" href="../css/colors.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" type="text/css" href="../css/carritoCompras.css">
    <link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
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
            echo "<h2>Confirmar compra</h2>";
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
    <div id="carrito" style="max-height: 60vh;">
    <table id='tablaCarrito'>
    <tbody id="bodyCarrito"> <!--nombre para POST-->
        <tr>
            <th>ID del producto</th>
            <th>Cantidad</th>
            <th>Nombre</th>
            <th>Divisible</th>
            <th>Imagen</th>
            <th>Valor por Paquete/Unidad</th>
            <th>Provedor</th>
            <th class="resultado">Resultado por cantidad</th>
        </tr>
        <?php
        $ids = $_POST['idPro'];
        $arrayIds = explode(',',$ids);
        $cantidades = $_POST['cantPro'];
        $arrayCant = explode(',',$cantidades);
        $i = 0;
        foreach($arrayIds as $id) {
            $consulta = "SELECT * from productos WHERE id='".$id."'";
            $resultado = mysqli_query($conexion,$consulta);
            while($datosProducto = $resultado->fetch_assoc()){
                echo "<tr>";;
                echo "<td id=elementoCarrito".$datosProducto['id'].">".$datosProducto['id']."</td>";
                echo "<td style='text-align: center;' id=cantidadElemento>".$arrayCant[$i]."</td>";
                echo "<td style='text-align: center;' >".$datosProducto['nombre']."</td>";
                echo "<td style='text-align: center;' >".$datosProducto['divisible']."</td>";
                echo "<td style='text-align: center;'><img src='".$datosProducto['imagen']."'alt='' width='50px' heigh='50px'></td>";
                echo "<td style='text-align: center;'>".$datosProducto['valor']."</td>";
                echo "<td style='text-align: center;'>".$datosProducto['provedor']."</td>";
                echo "<td style='text-align: center;'>".intval($arrayCant[$i])*$datosProducto['valor']."</td>";
                echo "</tr>";
                $i++;
            }
        }
        ?>
    <tfoot>
        <tr>
            <td colspan="8">Total</td>
            <td id="totalResult">$<?php echo $_POST['totalPro']?></td>
        </tr>
        <tr>
        <td colspan='6'>
            <form action="remito.php" target="_blank" method="POST">
                <input hidden type="text" name="idPro" value=<?php echo $_POST['idPro'];?>>
                <input hidden type="text" name="cantPro" value=<?php echo $_POST['cantPro'];?>>
                <input hidden type="text" name="valoresPro" value=<?php echo $_POST['valoresPro'];?>>
                <input hidden type="text" name="comprador" value=<?php echo $_SESSION["usuario"];?>>
                <label for="recurrente">¿Cliente recurrente?</label>
                <input id="checkCliente" onchange="validar()" type="checkbox" name="recurrente" value="TRUE" id="recurrente">
                <label for="recurrente">¿Cliente Nuevo?</label>
                <input disabled id="checkClienteNuevo" onchange="validar()" type="checkbox" name="recurrentenew" value="TRUE" id="recurrente">
                <label for="recurrente">¿Cliente Registrado?</label>
                <input disabled id="checkClienteRegistrado" onchange="validar()" type="checkbox" name="recurrentereg" value="TRUE" id="recurrente">
                <?php //carga dinamica SELECT
                    include_once('conexion.php');
                    $sql = "SELECT * FROM clientes";
                    $result = mysqli_query($conexion,$sql);
                    $provedores = mysqli_fetch_assoc($result);
                    echo "<label for='Cliente'>Clientes registrados:</label>";
                    echo "<select disabled name='cliente' id='SelectCliente'>";
                    echo "<option value='' selected >-</option>"; //preterminado
                        if (mysqli_num_rows($result)> 0){
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='".$row['id']."'>".$row['cliente']."</option>"; //opciones del select
                        }
                        }
                    echo "</select>";
                ?>  
                <input disabled required id="inputNombre" class="input" type="text" name="nombreCliente" placeholder="NOMBRE CLIENTE">
                <input disabled required id="inputCompania" class="input" type="text" name="companiaCliente" placeholder="COMPAÑIA">
                <input disabled required id="inputDni" class="input" type="text" name="dniCliente" placeholder="CUIL CLIENTE">
                <input disabled required class="input" id="credito" title="ingrese numero positivo para tener credito a favor, negativo para que el cliente tenga deuda" required type="number" name="credito" placeholder="CREDITO"><br>
                <input disabled required id="inputCategoria" class="input" type="text" name="categoriaCliente" placeholder="CATEGORIA">
                <button class="buttom" type='submit'>GENERAR PDF Y MANDAR HISTORIAL</button>
            </form>
            <button class="buttom"><a href="ventas.php" style="color: white; text-decoration:none">CANCELAR</a></button>
        </td>
        </tr>
    </tfoot>
    </tbody>
    </table>
    </div>
    </section>
    <footer>
        <div id='regresoFoot'>
            <a href='../index.php' class='vuelta'>HOME</a>
            <a href='gestion/cerrarSesion.php' class='vuelta'>Cerrar Sesion</a>
        </div>
        <div id='marcaDagua'>
            <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
        </div>
    </footer>
</body>
</html>
<script>
    function validar() {
        var check = document.getElementById("checkCliente");
        var checkNew = document.getElementById("checkClienteNuevo");
        var checkReg = document.getElementById("checkClienteRegistrado");
        var inputNombre = document.getElementById("inputNombre");
        var inputEmpresa = document.getElementById("inputCompania");
        var inputDni = document.getElementById("inputDni");
        var inputcredito = document.getElementById("credito");
        var inputCompania = document.getElementById("inputCompania");
        var inputCategoria = document.getElementById("inputCategoria");
        var SelectCliente = document.getElementById("SelectCliente");
        if (check.checked) {
            checkNew.disabled = false;
            checkReg.disabled = false;
        }else{
            checkNew.disabled = true;
            checkReg.disabled = true;
            checkNew.checked = false;
            checkReg.checked = false;
        }
        if(checkNew.checked){
            checkReg.checked = false;
            inputNombre.disabled = false;
            inputEmpresa.disabled = false;
            inputCategoria.disabled = false;
            inputDni.disabled = false;
            inputCompania.disabled = false;
            inputcredito.disabled = false;
        }
        else{
            inputNombre.disabled = true;
            inputEmpresa.disabled = true;
            inputCategoria.disabled = true;
            inputDni.disabled = true;
            inputCompania.disabled = true;
            inputcredito.disabled = true;
        }
        if(checkReg.checked){
            checkNew.checked = false;
            SelectCliente.disabled = false;
        }
        else{
            SelectCliente.disabled = true;
        }
    }
</script>
