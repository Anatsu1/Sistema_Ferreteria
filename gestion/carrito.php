<?php
include('conexion.php');

$id = $_GET['q'];

$cantidad = $_GET['c'];

if ($cantidad <= 0) {
    $cantidad = 1;
}

$sql = "SELECT * FROM productos WHERE id = $id";

$resultado = mysqli_query($conexion,$sql);

$datosProducto = mysqli_fetch_assoc($resultado);

echo "<tr id=elementoCarrito".$datosProducto['id'].">";
echo "<td style='text-align: center;' >".$datosProducto['id']."</td>";
echo "<td style='text-align: center;' id=cantidadElemento>".$cantidad."</td>";
echo "<td style='text-align: center;' >".$datosProducto['nombre']."</td>";
echo "<td style='text-align: center;' >".$datosProducto['divisible']."</td>";
echo "<td style='text-align: center;'><img src='".$datosProducto['imagen']."' alt='' width='50px' heigh='50px'></td>";
echo "<td style='text-align: center;'>".$datosProducto['valor']."</td>";
echo "<td style='text-align: center;'>".$datosProducto['provedor']."</td>";
echo "<td class='resultado'>".$cantidad * $datosProducto['valor']."</td>";
echo "<button class='buttom' id=botonCarrito".$datosProducto['id']." onclick='borrarItemCarrito(".$datosProducto['id'].")'>Borrar</button>";
echo "</tr>";


?>