<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $codigo = $_POST["codigo"];

    $xml = simplexml_load_file('usuarios.xml');
    foreach ($xml->usuario as $usuario) {
        if ($usuario->email == $email && $usuario->password == $password) {
            // Usuario autenticado correctamente

            // Obtener el tipo de suscripción del usuario
            $tipoSuscripcion = (string) $usuario->suscripcion;

            // Verificar el código y redirigir según el tipo de suscripción o el código
            if ($codigo == "soyadminDAW") {
                header("Location: fAccesoAdmin.php");
            } else {
                // Redirigir según el tipo de suscripción
                switch ($tipoSuscripcion) {
                    case 'basico':
                        header("Location: fAccesoBasico.php");
                        break;
                    case 'premium':
                        header("Location: fAccesoPremium.php");
                        break;
                    
                }
            }

            exit();
        }
    }

    // Los datos de inicio de sesión no son válidos
    $error = "Correo electrónico o contraseña incorrectos";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" type="text/css" href="fInicioSesion.css">

</head>
<body>

<h2>Inicio de Sesión</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br>

    <label for="codigo">Código:</label>
    <input type="text" id="codigo" name="codigo"><br>

    <span style="color: red;"><?php echo isset($error) ? $error : ''; ?></span><br>

    <input type="submit" value="Iniciar Sesión">
    <a href="index.php"><input type="button" value="Volver"></a>


</form>

</body>
</html>
