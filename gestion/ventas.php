<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas</title>
  <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
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
            echo "<h2>Carrito de compras</h2>";
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
  <h3>Busqueda de productos</h3>
    <form id="formTabla">
      <label for='provedores'>Nombre:</label>  
      <input id='inputBusqueda' placeholder='Nombre del producto' type='text' size='30' onkeyup='showResult()'>
      <div id='livesearch'></div>

      <?php //carga dinamica SELECT
      include_once('conexion.php');
      $sql = "SELECT * FROM provedor";
      $result = mysqli_query($conexion,$sql);
      $provedores = mysqli_fetch_assoc($result);

      echo "<label for='provedores'>Provedor:</label>";
      echo "<select name='provedores' id='SelectProvedores' onchange='showResult()'>";
      echo "<option value='' selected >todos los provedores</option>"; //preterminado
        if (mysqli_num_rows($result)> 0){
          echo "<option value='".$provedores['nombre']."'>".$provedores['nombre']."</option>";
          while ($row = mysqli_fetch_array($result)) {
            echo "<option value='".$row['nombre']."'>".$row['nombre']."</option>"; //opciones del select
          }
        }else{
          echo "<option value=''>todos</option>"; //sin provedores
        }
      echo "</select>";
      ?>

    </form>
  </div>
  <div id='txtHint'><b>Datos del producto aqui...</b></div>
  <div id='carrito'>
    <table id='tablaCarrito' name="tablaCarrito">
      <tbody id="bodyCarrito"> <!--nombre para POST-->
      <tr id="tableHead">
      <th>ID producto</th>
      <th>Cantidad</th>
      <th>Nombre</th>
      <th>Divisible en</th>
      <th>Imagen</th>
      <th>Valor por Paquete/Unidad</th>
      <th>Provedor</th>
      <th class="resultado">Resultado por cantidad</th>
      </tr>
      <!--productos cargador por AJAX-->
      </tbody>
      <tfoot>
        <tr>
          <td colspan="8">Total</td>
          <td id="totalResult">0</td>
        </tr>
          <tr>
          <td colspan='8'>
          <form id="formCarrito" action='confirmarCarrito.php' method='POST'>
            <input hidden id="idsPro" type='text' name='idPro' value="">
            <input hidden id="cantsPro" type='text' name='cantPro' value="">
            <input hidden id="totalPro" type='text' name='totalPro' value="">
            <input hidden id="valoresPro" type='text' name='valoresPro' value=""> <!--agregado por mati para historial-->
            <button class="buttom" id="enviar" type='submit' disabled="disabled">ENVIAR</button>
          </form>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</section>
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
function showResult() {
  var nombre = document.getElementById('inputBusqueda');
  var provedor = document.getElementById('SelectProvedores').value;
    if (nombre == '' && provedor == '') {
      document.getElementById('txtHint').innerHTML = '';
      return;
    } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('txtHint').innerHTML = this.responseText;
        
      }
    };
    xmlhttp.open('GET','buscadorVentas.php?q='+nombre.value+'&p='+provedor,true);
    xmlhttp.send();
  }
}

function recuperarCarrito(id,cant){
  document.getElementById('cantidadVenta'+id).value = cant;
  agregarCarrito(id);
}

function agregarCarrito(str) { //agregar producto
  var cantidad = document.getElementById('cantidadVenta'+str).value;
  var xhttp;
  var resultado;
  let repetido = verificarRepetidos(str);;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
    if(repetido > 0){
      borrarItemCarrito(str);
    }
    document.getElementById("bodyCarrito").innerHTML += this.responseText;
    calcularTotal();
    cargarArreglos();
  }
  };
  xhttp.open("GET", "carrito.php?q="+str+"&c="+(Number(cantidad)+Number(repetido)), true);
  xhttp.send();
}

function cargarArreglos(){
  var tablaCarrito = document.getElementById("tablaCarrito");
  var idsPro = document.getElementById("idsPro");
  var cantsPro = document.getElementById("cantsPro");
  var valoresPro = document.getElementById("valoresPro");
  document.getElementById("enviar").disabled = "disabled";
  var ids = [];
  var cants = [];
  var valors = [];
  for(let i = 1; i < tablaCarrito.rows.length-2; i++){
    ids[i-1] = tablaCarrito.rows[i].cells[0].innerHTML;
    cants[i-1] = tablaCarrito.rows[i].cells[1].innerHTML;
    valors[i-1] = tablaCarrito.rows[i].cells[5].innerHTML;
    document.getElementById("enviar").disabled = false;
  }
  idsPro.value = ids.join();
  cantsPro.value = cants.join();
  valoresPro.value = valors.join();
}

function calcularTotal(){
  let total = 0;
  const tablaCarrito = document.getElementById("tablaCarrito");
  for(let i = 1; i < tablaCarrito.rows.length-2; i++){
    let valorTotal = tablaCarrito.rows[i].cells[7].innerHTML;
    total = total + Number(valorTotal);
  }
  const tdTotal = document.getElementById("totalResult");
  document.getElementById("totalPro").value = total;
  tdTotal.textContent = "$"+total;

}

function verificarRepetidos(id){
  let bandera = 0;
  const tablaCarrito = document.getElementById("tablaCarrito");
  for(let i = 1; i < tablaCarrito.rows.length-2; i++){
    let existente = tablaCarrito.rows[i].cells[0].innerHTML;
    if(id == existente){
      bandera = tablaCarrito.rows[i].cells[1].innerHTML;
    }
  }
  return bandera;
}

function borrarItemCarrito(id) {
  var nodoTabla = document.getElementById('elementoCarrito'+id);
  var botonItem = document.getElementById('botonCarrito'+id);
  botonItem.remove();
  nodoTabla.parentNode.removeChild(nodoTabla); //elimina la fila con los datos del carrito
  calcularTotal();
  cargarArreglos();
}

</script>