<?php
$q = $_GET['q'];
$provedor = $_GET['p'];
include('conexion.php');

if ($provedor == '' && $q != '') { //si provedor es vacio y nombre tiene algo
  //busqueda por nombre
  $sql = "SELECT * FROM productos WHERE nombre LIKE '%".$q."%'";
} else {
  if ($provedor != '' && $q == '') { //si provedor tiene algo y nombre es vacio
    //busqueda por provedor
    $sql = "SELECT * FROM productos WHERE provedor LIKE '%".$provedor."%'";
  } else {
    if($q == '' && $provedor == ''){ //si provedor y nombre es vacio 
      $sql = "SELECT * FROM productos";
    }else{
      $sql = "SELECT * FROM productos WHERE nombre LIKE '%".$q."%' AND provedor LIKE '%".$provedor."%'";
    }
  }
}

$result = mysqli_query($conexion,$sql);

echo "<div id='tablaLiveProd'>
<div class='boxGrid'>Codigo</div>
<div class='boxGrid'>Nombre</div>
<div class='boxGrid'>Cantidad</div>
<div class='boxGrid'>Divisible</div>
<div class='boxGrid'>Valor</div>
<div class='boxGrid'>Multiplicador</div>
<div class='boxGrid'>Provedor</div>
<div class='boxGrid boxFunc'>Funciones</div>";
if(mysqli_num_rows($result) > 0){
  while($fila = mysqli_fetch_assoc($result)) { 
    echo "<div class='boxGrid'>".$fila['codigoProducto']."</div>";
    echo "<div class='boxGrid'>".$fila['nombre']."</div>";
    echo "<div class='boxGrid'>".$fila['cantidad']."</div>";
    echo "<div class='boxGrid'>".$fila['divisible']."</div>";
    echo "<div class='boxGrid'>".$fila['valor']."</div>";
    echo "<div class='boxGrid'>".$fila['multiplicador']."</div>";
    echo "<div class='boxGrid'>".$fila['provedor']."</div>";
    echo "<div class='boxGrid'><input class='input' id='cantidadVenta".$fila['id']."' required placeholder='ingrese cantidad' type='number'></div>"; 
    echo "<div class='boxGrid'><button type='submit' class='buttom'onclick='agregarCarrito(".$fila['id'].")'>Agregar al carrito</button></div>";
  }
  echo "</div>";
}
 else {
  echo "<div class='boxGrid'>Sin</div>";
  echo "<div class='boxGrid'>Resultados</div>";
}


mysqli_close($conexion);
?>
</body>
</html>