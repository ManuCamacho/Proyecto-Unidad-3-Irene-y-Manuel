<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario PHP</title>
    <link rel="stylesheet" type="text/css" href="fAccesoAdmin.css">
</head>

<body>
    <h2>Selecciona una opción:</h2>

    <!-- Formulario con botones -->
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <button type="submit" name="accion" value="pelis">Mostrar Películas</button><br><br>
        <button type="submit" name="accion" value="series">Mostrar Series</button><br><br>
        <button type="submit" name="accion" value="gestionar">Gestionar Contenido</button>
    </form>

    <?php
    // Comprobación de la solicitud POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Obtener el valor del botón presionado
        $accion = $_POST["accion"];

        // Realiza la acción correspondiente
        if ($accion == "pelis") {
            // Redireccionar a la página de gestión de películas
            header("Location: fPeliculas.php");
            exit();
        } elseif ($accion == "series") {
            // Redireccionar a la página de gestión de series
            header("Location: fSeries.php");
            exit();
        } elseif ($accion == "gestionar") {
            // Redireccionar a la página de gestión de contenido
            header("Location: FGestionarContenido.php");
            exit();
        }
    }
    ?>
            <a href="javascript:history.back()" class="boton">Volver</a>

</body>

</html>
