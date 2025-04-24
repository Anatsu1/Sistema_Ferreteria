<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/colors.css">
    <link rel="stylesheet" type="text/css" href="../css/formLogReg.css">
    <link rel="icon" type="image/x-icon" href="../imagenes/iconos/ferreteria.ico">
    <title>Iniciar Sesion</title>
</head>
<body>
    <div id="contenedor">
            <div id="central">
                <div id="login">
                    <div class="titulo">
                        Bienvenido
                    </div>
                    <form id="loginform" action="validarSesion.php" method="POST">
                        <input type="text" name="usuario" placeholder="usuario" required>
                        
                        <input type="password" placeholder="Contraseña" name="password" required>
                        
                        <button type="submit" title="Ingresar" name="Ingresar">Login</button>
                    </form>
                    <div class="pie-form">
                        <a href="registrarUsuario.php">¿No tienes Cuenta? Registrate</a>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>