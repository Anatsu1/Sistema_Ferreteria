<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/colors.css">
    <link rel="stylesheet" type="text/css" href="../css/formLogReg.css">
    <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
	<title>Registrar usuario</title>
</head>
<body>
  <div id="contenedor">
            <div id="central">
                <div id="login">
                    <div class="titulo">
                        Bienvenido
                    </div>
                    <form id="loginform" action="validarRegistro.php" method="POST">
                        <label for="">Nombre</label><input type="text" name="nombre" placeholder="ingrese su Nombre">
                        <label for="">DNI</label><input type="number" name="dni" placeholder="ingrese su DNI">
                        <label for="">Contraseña</label><input type="text" name="contra" placeholder="ingrese su Contraseña">
                        <label for="">Tipo Usuario</label><input list="usuarios" name="estado">
                        <datalist id="usuarios">
                        <option value='usuario'>
                        <option value='socio'>
                        </datalist>
                        <button type="submit" title="Ingresar" name="Ingresar">Registrarse</button>
                    </form>
                    <div class="pie-form">
                        <a href="iniciarSesion.php">¿Tienes Cuenta?</a>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>