<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Series</title>
    <link rel="stylesheet" type="text/css" href="fSeries.css">
</head>

<body>
    <div class="container">
        <h2>Series disponibles:</h2>
        <?php
        $xml = simplexml_load_file('contenido_series.xml');
        if ($xml === false) {
            die('Error al cargar el archivo XML');
        }

        foreach ($xml->serie as $serie) {
            $id = $serie->id;
            $titulo = $serie->titulo;
            $anio = $serie->anio_estreno;
            $edad_recomendada = $serie->edad_recomendada;
            $temporada = $serie->num_temporadas;
            $num_capitulos = $serie->num_capitulos;
        
            echo "<div class='series-block'>";
            echo "<strong>ID:</strong> $id<br>";
            echo "<strong>Título:</strong> $titulo<br>";
            echo "<strong>Año:</strong> $anio<br>";
            echo "<strong>Edad Recomendada:</strong> $edad_recomendada<br>";
            echo "<strong>Temporadas:</strong> $temporada<br>";
            echo "<strong>Número de Capítulos:</strong> $num_capitulos<br>";
            echo "</div>";
        }
        ?>
        
        <a href="javascript:history.back()" class="boton">Volver</a>
    </div>
</body>

</html>
