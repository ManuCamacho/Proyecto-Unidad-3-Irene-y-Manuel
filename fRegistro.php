<?php
 require_once "Usuario.php";

// Inicializar variables de mensajes de error
$errores = [
    'email' => '',
    'password' => '',
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $subscription = $_POST["subscription"];

    // Validación: Verificar si el email ya está registrado
    if (emailRegistrado($email)) {
        $errores['email'] = '¡El correo electrónico ya está registrado!';
    }

    // Validación: Verificar la contraseña
    if (!validarContraseña($password)) {
        $errores['password'] = '¡La contraseña debe tener al menos 6 caracteres, una mayúscula y un número!';
    }

    // Si no hay errores, proceder con el registro
    if (empty($errores['email']) && empty($errores['password'])) {
        $nuevoUsuario = new Usuario($username, $password, $email, $name);

        $xml = simplexml_load_file('usuarios.xml');
        $nuevoUsuarioXML = $xml->addChild('usuario');
        $nuevoUsuarioXML->addChild('nombre_usuario', $nuevoUsuario->getNombreUsuario());
        $nuevoUsuarioXML->addChild('password', $nuevoUsuario->getPassword());
        $nuevoUsuarioXML->addChild('email', $nuevoUsuario->getEmail());
        $nuevoUsuarioXML->addChild('nombre', $nuevoUsuario->getNombre());
        $nuevoUsuarioXML->addChild('suscripcion', $subscription);

        $xml->asXML('usuarios.xml');

        header("Location: fInicioSesion.php");
        exit(); 
    }
}

function emailRegistrado($email)
{
    $xml = simplexml_load_file('usuarios.xml');
    foreach ($xml->usuario as $usuario) {
        if ($usuario->email == $email) {
            return true; // El email está registrado
        }
    }
    return false; // El email no está registrado
}

function validarContraseña($password)
{
    // La contraseña debe tener al menos 6 caracteres, una mayúscula y un número
    return strlen($password) >= 6 && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" type="text/css" href="fregistro.css">
</head>
<body>

<h2>Registro de Usuario</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <!-- Campos del formulario -->

    <label for="username">Nombre de Usuario:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>
    <span style="color: red;"><?php echo $errores['email']; ?></span><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <span style="color: red;"><?php echo $errores['password']; ?></span><br>

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="subscription">Tipo de Suscripción:</label>
    <select id="subscription" name="subscription" required>
        <option value="basico">Básico = 7€</option>
        <option value="premium">Premium = 12€</option>
    </select><br>
    
    <!-- Botones de envío y volver -->
    <input type="submit" value="Registrar">
    <a href="index.php"><input type="button" value="Volver"></a>
</form>



</body>
</html>
