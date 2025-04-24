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
<div class='boxGrid'>Provedor</div>
<div class='boxGrid boxFunc'>Funciones</div>";
if(mysqli_num_rows($result) > 0){
  while($fila = mysqli_fetch_assoc($result)) { 
    echo "<div class='boxGrid'>".$fila['codigoProducto']."</div>";
    echo "<div class='boxGrid'>".$fila['nombre']."</div>";
    echo "<div class='boxGrid'>".$fila['cantidad']."</div>";
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
}
 else {
  echo "<div class='boxGrid'>Sin</div>";
  echo "<div class='boxGrid'>Resultados</div>";
}


mysqli_close($conexion);
?>
</body>
</html>