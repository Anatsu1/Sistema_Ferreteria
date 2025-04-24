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
</head>
<body>
    <header>
    <div id="usuario">
    <?php
    session_start();
    include("../gestion/conexion.php");
    if(empty($_SESSION["usuario"])){
        header("Location: ../gestion/iniciarSesion.php");
    }
    else{
        echo "<h2>Bienvenido ".$_SESSION["usuario"]."</h2>";
    }
    ?>  
    </div>
    <div id="botonera">
        <form action="../gestion/ventas.php" method="post">
            <button class="boton" type="submit">Ventas</button>
        </form> <!--Ventas-->
        <form action="../gestion/credito.php" method="post">
            <button class="boton" type="submit">Historial de compras / Credito</button>
        </form> <!--Credito-->
        <form action="../gestion/productos.php" method="post">
            <button class="boton" type="submit">Ver Productos</button>
        </form> <!--Ver Productos-->
        <form action="../gestion/provedores.php" method="post">
            <button class="boton" type="submit">Ver Provedores</button>
        </form> <!--Ver Provedores-->
    </div>
    </header>
    <!--Menu Navegacion-->

    <p style="color:red;">Importante: las columnas sobre el archivo excel tiene que estar en este formato: </p>
    <p style="color:red;">  nombre - cantidad - divisible - imagen - valor - proovedor  </p>
    <p style="color:red;">¡cualquier columna extra hara que no se suban los datos correctamente!  </p>
    <br>
    <form class="" action="" method="post" enctype="multipart/form-data">
		<input type="file" name="excel" required value="">
		<button type="submit" name="import">Cargar</button>
	</form>
    <br>
		<hr>
		<table>
			<tr>
				<td>#</td>
				<td>nombre</td>
				<td>cantidad</td>
				<td>divisible</td>
                <td>imagen</td>
                <td>valor</td>
                <td>provedor</td>
			</tr>
			<?php
			$i = 1;
			$rows = mysqli_query($conexion, "SELECT * FROM productos");
			foreach($rows as $row) :
			?>
			<tr>
				<td> <?php echo $i++; ?> </td>
				<td> <?php echo $row["nombre"]; ?>  </td>
				<td> <?php echo $row["cantidad"]; ?>  </td>
				<td> <?php echo $row["divisible"]; ?>  </td>
                <td> <?php echo $row["imagen"]; ?>  </td>
                <td> <?php echo $row["valor"]; ?>  </td>
                <td> <?php echo $row["provedor"]; ?>  </td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php
		if(isset($_POST["import"])){
			$fileName = $_FILES["excel"]["name"];
			$fileExtension = explode('.', $fileName);
            $fileExtension = strtolower(end($fileExtension));

            //nuevo nombre para el Excel
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

            //directorio de guardado
			$targetDirectory = "../uploads/" . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require '../excelReader/excel_reader2.php';
			require '../excelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $row){
				$nombre = $row[0];
				$cantidad = $row[1];
                $divisible = $row[2];
                $imagen = $row[3];
                $valor = $row[4];
				$provedor = $row[5];
                //insercion de datos
				mysqli_query($conexion, "INSERT INTO productos VALUES('', '$nombre', '$cantidad', '$divisible','$imagen','$valor','$provedor')");
			}

			echo //recarga de pagina una vez completada la carga
			"
			<script>
			alert('Cargado Exitosamente');
			document.location.href = '';
			</script>
			";
		}
		?>

<footer>
    <div id="regresoFoot">
        <a href='../gestion/cerrarSesion.php' class='vuelta'>Cerrar Sesion</a>
    </div>
    <?php
        if (isset($_SESSION["usuario"]) && $_SESSION["estado"] == "administrador") {
            echo "<div id='regresoFoot'>
                    <a href='../gestion/gestionBD.php' class='vuelta'>Gestion EXCEL</a>
                  </div>";
        }
    ?>
    <div id="marcaDagua">
        <h4>Creado por: Matias Gigena/Cesar Augusto Fernandez Carbonell</h4>
    </div>
</footer>
</body>
</html>