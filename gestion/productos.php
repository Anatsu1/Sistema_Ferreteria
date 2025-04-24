<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/colors.css">
  <link rel="stylesheet" type="text/css" href="../css/tablaProdProv.css">
  <link rel="stylesheet" type="text/css" href="../css/index.css">
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <link rel="stylesheet" type="text/css" href="../css/footer.css">
  <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
  <title>Productos</title>
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
        echo "<h2>Tabla productos</h2>";
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
        <h3>Busqueda de productos</h3>
        <label for='provedores'>Nombre:</label>  
        <input id='inputBusqueda' placeholder='Escriba el nombre del producto a buscar' type='text' size='35' onkeyup='showResult(this.value)'>
        <div id='livesearch'></div>
        <?php //carga dinamica SELECT
        include_once('conexion.php');
        $sql = "SELECT * FROM provedor";
        $result = mysqli_query($conexion,$sql);
        $provedores = mysqli_fetch_assoc($result);
        echo "<label for='provedores'>Provedor:</label>";
        echo "<select name='provedores' id='SelectProvedores' onchange='showResult(this.value)'>";
        echo "<option value='' selected >todos los provedores</option>"; //preterminado
          if (mysqli_num_rows($result)> 0){
            echo "<option value='".$provedores['nombre']."'>".$provedores['nombre']."</option>";
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='".$row['nombre']."'>".$row['nombre']."</option>"; //opciones del select
            }
          }else{
            echo "<option value=''>todos</option>"; //sin provedores
          }
        echo "</select>";
      ?>

      </form>
    <div id='txtHint'><b>Datos del producto aqui...</b></div>
    </div>
    <div id="tabla">
    <?php
      include('conexion.php');
      $sql = "SELECT * FROM productos";
      $result = mysqli_query($conexion,$sql);
      
      echo "<div id='tablaProductos'>
      <div class='boxGrid boxHed'>Codigo</div>
      <div class='boxGrid boxHed'>Nombre</div>
      <div class='boxGrid boxHed'>Tipo</div>
      <div class='boxGrid boxHed'>Cantidad</div>
      <div class='boxGrid boxHed'>Divisible</div>
      <div class='boxGrid boxHed'>Valor</div>
      <div class='boxGrid boxHed'>Provedor</div>
      <div class='boxGrid boxHed boxFunc'>Funciones</div>";
      if (mysqli_num_rows($result)> 0) {
        while($fila = mysqli_fetch_assoc($result)) { //mostrar despues del 1er elemento
          echo "<div class='boxGrid'>".$fila['codigoProducto']."</div>";
          echo "<div class='boxGrid'>".$fila['nombre']."</div>";
          echo "<div class='boxGrid'>".$fila['tipo']."</div>";
          if($fila['cantidad'] < $fila['cantidadMinima']){
            echo "<div class='boxGrid' style='color: red;'>".$fila['cantidad']."</div>";
          }else{
            echo "<div class='boxGrid'>".$fila['cantidad']."</div>";
          }
          echo "<div class='boxGrid'>".$fila['divisible']."</div>";
          echo "<div class='boxGrid'>".$fila['valor']."</div>";
          echo "<div class='boxGrid'>".$fila['provedor']."</div>";
          echo "<div class='boxGrid'><form action='modificarProducto.php' method='GET'>
                      <input hidden type='number' name='id' value='".$fila['id']."'>
                      <button class='buttom' type='submit'>Ver/Modificar</button>
                </form></div>";
          echo "<div class='boxGrid'><form action='borrarProducto.php' method='POST'>
                  <input hidden type='number' name='idProducto' value='".$fila['id']."'>
                  <input hidden type='text' name='imagen' value='".$fila['imagen']."'>
                  <button class='buttom' type='submit'>Borrar Producto</button>
              </form></div>";
        }
        echo "</div>";
        
      } else {
        echo "<div class='boxGrid'>Sin</div>";
        echo "<div class='boxGrid'>Resultados</div>";
      }
    ?>
    </div>
    <br>
    
      
  </section>
  <footer>
    <div id="regresoFoot">
        <a href='../index.php' class='vuelta'>HOME</a>
        <a class="funcion" href='crearProducto.php'>Crear Producto</a>
    </div>
    <div id="marcaDagua">
        <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
    </div>
</footer>
</body>
<script>
        function showResult(str) {
          var nombre = document.getElementById('inputBusqueda').value;
          var select = document.getElementById('SelectProvedores').value;
        if (nombre == '' && select == '') {
          document.getElementById('txtHint').innerHTML = '';
          return;
        } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('txtHint').innerHTML = this.responseText;
          }
        };
        xmlhttp.open('GET','liveSearchProductos.php?q='+nombre+"&p="+select,true);
        xmlhttp.send();
      }
    }
    </script>
</html>
