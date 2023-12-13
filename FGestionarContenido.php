<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Contenido</title>
    <!-- Enlace al archivo CSS para estilos -->
    <link rel="stylesheet" type="text/css" href="fGestionarContenido.css">
</head>

<body>
    <h2>Gestionar Contenido</h2>

    <!-- Formulario con botones para gestionar películas y series -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button type="submit" name="accion" value="peliculas">Gestionar Películas</button><br><br>
        <button type="submit" name="accion" value="series">Gestionar Series</button>
    </form>

    <?php
    // Comprobación de la solicitud POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el valor del botón presionado
        $accion = $_POST["accion"];

        // Realizar la acción correspondiente
        if ($accion == "peliculas") {
            // Redireccionar a la página de gestionar películas
            header("Location: FGestionarContenidoPelis.php");
            exit();
        } elseif ($accion == "series") {
            // Redireccionar a la página de gestionar series
            header("Location: FGestionarContenidoSeries.php");
            exit();
        }
    }
    ?>
    <a href="javascript:history.back()" class="boton">Volver</a>
</body>
</html>
