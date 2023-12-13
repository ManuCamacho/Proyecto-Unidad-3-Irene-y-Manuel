<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Películas</title>

    <!-- Enlace al archivo CSS para estilos -->
    <link rel="stylesheet" type="text/css" href="fPeliculas.css">
</head>

<body>
    <div class="container">
        <h2>Películas disponibles:</h2>

        <?php
        // Cargar el contenido existente del archivo XML
        $xml = simplexml_load_file('contenido.xml');

        // Mostrar información de cada película en el XML
        foreach ($xml->pelicula as $pelicula) {
            $id = $pelicula->id;
            $titulo = $pelicula->titulo;
            $anio = $pelicula->aniopelicula;
            $edad_recomendada = $pelicula->edad_recomendada;
            $cod = $pelicula->cod;
            $duracion = $pelicula->duracion;

            // Mostrar información básica de la película en un bloque distinto
            echo "<div class='movie-block'>";
            echo "<strong>ID:</strong> $id<br>";
            echo "<strong>Título:</strong> $titulo<br>";
            echo "<strong>Año:</strong> $anio<br>";
            echo "<strong>Edad Recomendada:</strong> $edad_recomendada<br>";
            echo "<strong>Código:</strong> $cod<br>";
            echo "<strong>Duración:</strong> $duracion<br>";

            // Mostrar géneros de la película
            echo "<strong>Géneros:</strong>";
            foreach ($pelicula->generos->genero as $genero) {
                echo " $genero";
            }

            // Cerrar la etiqueta div
            echo "</div>";
        }
        ?>
                <a href="javascript:history.back()" class="boton">Volver</a>

    </div>
</body>

</html>
