<?php
include('conexion.php');

$q = $_GET['q']; //nombre del cliente en input
$sql = "SELECT * FROM clientes WHERE dniCuil LIKE '%".$q."%'";
$result = mysqli_query($conexion,$sql);
$clientesLive = mysqli_fetch_assoc($result);
if ($q != '') {
echo "<div id='tablaHistorial'>
<div class='boxGrid boxHed'>Nombre</div>
<div class='boxGrid boxHed'>DNI/Cuil</div>
<div class='boxGrid boxHed'>Empresa</div>
<div class='boxGrid boxHed'>Credito</div>
<div class='boxGrid boxHed'>Categoria</div>
<div class='boxGrid boxHed boxFunc'>Funciones</div>";
if (mysqli_num_rows($result) == 1) {
    echo "<div class='boxGrid'>".$clientesLive['cliente']."</div>";
    echo "<div class='boxGrid'>".$clientesLive['dniCuil']."</div>";
    echo "<div class='boxGrid'>".$clientesLive['empresa']."</div>";
    if ($clientesLive['credito'] < 0) {
        echo "<div class='boxGrid' style='background-color:Tomato;'>".$clientesLive['credito']."</div>";//credito negativo
    } else {
        echo "<div class='boxGrid' style='background-color:MediumSeaGreen;'>".$clientesLive['credito']."</div>";//credito positivo
    }
    echo "<div class='boxGrid'>".$clientesLive['categoria']."</div>";
    echo "<div class='boxGrid'>
    <form action='historialCliente.php' method='post'>
    <input hidden name='dni' value=".$clientesLive['dniCuil'].">
    <button class='buttom' type='submit'>Ver Historial de Compra</button>";
    echo"</form></div>";
    echo "<div class='boxGrid boxHed'> 
    <form action='cancelarDeuda.php' method='post'>
    <input hidden name='dni' value=".$clientesLive['dniCuil'].">
    <button class='buttom' type='submit'>Cancelar Deuda del Cliente</button>";
    echo "</form></div>";
}else{
  echo "<div class='boxGrid'>Sin</div>
  <div class='boxGrid'>Resultados</div> 
  </div>";
}
}else {
    ob_clean();
}
mysqli_close($conexion);
?>
</body>
</html>