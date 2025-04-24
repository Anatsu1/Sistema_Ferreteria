<?php
require("../fpdf/fpdf.php");
require("conexion.php");
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $recurrente = false;
    if(isset($_POST['recurrente']))
        $recurrente = $_POST['recurrente'];
    // Logo
    //$this->Image('logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Lista de Productos','B',0,'C');
    $this->SetFont('Arial','B',10);
    $this->Cell(85,0,"Venta realizada por: ".$_POST['comprador'],0,0,'C');
    if($recurrente && isset($_POST['recurrentenew'])){
        $this->Cell(-80,10,"Compra realizada por dni: ".$_POST['dni_cliente'],0,0,'C');
    }
    $this->SetFont('Arial','B',15);
    // Salto de línea
    $this->Ln(20);

    $this->Cell(20,10,"N",1,0,"C",0);
    $this->Cell(30,10,"Nombre",1,0,"C",0);
    $this->Cell(30,10,"Cantidad",1,0,"C",0);
    $this->Cell(30,10,"Proveedor",1,0,"C",0);
    $this->Cell(40,10,"Valor Unidad",1,0,"C",0);
    $this->Cell(40,10,"Subtotal",1,1,"C",0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',12);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página').$this->PageNo().'/{nb}',0,0,'C');
}
}

$ids = $_POST['idPro'];
$arrayIds = explode(',',$ids);
$cantidades = $_POST['cantPro'];
$arrayCant = explode(',',$cantidades);
$valores = $_POST['valoresPro'];
$arrayValores = explode(',',$valores);
$i = 1;
$total = 0;

// Creación del objeto de la clase heredada

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFillColor(233,229,235);
$pdf->SetFillColor(61,61,61);
$pdf->SetFont('Helvetica','',12);
foreach($arrayIds as $id) {
    $consulta = "SELECT * from productos WHERE id='".$id."'";
    $resultado = mysqli_query($conexion,$consulta);
    while($fila = $resultado->fetch_assoc()){
        $total = $total + intval($arrayCant[$i-1])*$fila['valor'];
        $pdf->Cell(20,10,$i,'B',0,'C',0);
        $pdf->Cell(30,10,$fila['nombre'],'B',0,'C',0);
        $pdf->Cell(30,10,$arrayCant[$i-1],'B',0,'C',0);
        $pdf->Cell(30,10,$fila['provedor'],'B',0,'C',0);
        $pdf->Cell(40,10,$fila['valor'],'B',0,'C',0);
        $pdf->Cell(40,10,intval($arrayCant[$i-1])*$fila['valor'],'B',1,'C',0);
        //
        $i++;
    }
}
$pdf->SetFont('Helvetica','',16);
$pdf->Cell(20,20,'Total: ',0,0,'C');
$pdf->SetFont('Helvetica','B',16);
$pdf->Cell(10,20,'$'.$total,0,1,'C');
$pdf->Output();

//guardar compra

//datos dia
$fecha = date("Y/m/d");

if($recurrente){
    //datos cliente
    if(isset($_POST['recurrentenew'])){
        $compania = $_POST['compania'];
        $cliente = $_POST['dni_cliente'];
        $credito = $_POST['credito'];
    }
    if(isset($_POST['recurrentereg'])){
        $idclienteReg = $_POST['cliente'];
        $sql = "SELECT * FROM clientes WHERE id = '".$idclienteReg."'";
        $resultadoCliente = mysqli_query($conexion,$sql);
        $datosCliente = mysqli_fetch_assoc($resultadoBusqueda);
        $compania = $datosCliente['compania'];
        $cliente = $datosCliente['dni_cliente'];
        $credito = $datosCliente['credito'];
    }

    $jsonArray = array();
    for($i = 0; $i < count($arrayIds); $i++){
        $jsonArray[] = array(
                'id' => $arrayIds[$i],
                'cantidad' => $arrayCant[$i],
                'valor' => $arrayValores[$i],
            );
    }

    $arregloDatosJson = serialize($jsonArray);

    //ingreso de compra a bd
    $sql = "INSERT INTO historial( cliente, compania, recurrente, datos, fecha) VALUES ('".$cliente."','".$compania."','".$recurrente."','".$arregloDatosJson."','".$fecha."')";
    $resultadoConsulta = mysqli_query($conexion,$sql);

    //sistema de credito 
    if ($recurrente) { //si es recurrente
        $sqlSelect = "SELECT * FROM clientes WHERE dniCuil = ".$cliente;
        $resultadoBusqueda = mysqli_query($conexion,$sqlSelect);
        if (mysqli_num_rows($resultadoBusqueda) == 1) {
            //si existe modificamos su credito
            $datosCliente = mysqli_fetch_assoc($resultadoBusqueda);
            $creditoFinal = $datosCliente['credito'] + $credito;
            $sqlUpdate = "UPDATE clientes SET credito = '".$creditoFinal."' WHERE dniCuil = ".$cliente."";
            mysqli_query($conexion,$sqlUpdate);
        } else {
            //si no, creamos el cliente
            $crear = "INSERT INTO clientes(dniCuil, credito, empresa) VALUES ('".$cliente."','".$credito."','".$compania."')";
            $resultadoCrear = mysqli_query($conexion,$crear);
        }
    }
}

?>