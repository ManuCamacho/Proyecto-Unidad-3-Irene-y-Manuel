<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Contenido: Series</title>
    <link rel="stylesheet" type="text/css" href="FgestionarContenidoSeries.css">
</head>

<body>

    <h2>Gestionar Contenido: Series</h2>
    <div class="forms-container">
        <form action="" method="post">
            <!-- Campos para agregar una serie -->
            <h3>Añadir Serie</h3>
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" required>
            <br>
            <br>
            <label for="anio_estreno">Año de Estreno:</label>
            <input type="text" name="anio_estreno" required>
            <br>
            <br>
            <label for="edad_recomendada">Edad Recomendada:</label>
            <input type="text" name="edad_recomendada" required>
            <br>
            <br>
            <label for="generos">Géneros (separados por comas):</label>
            <input type="text" name="generos" required>
            <br>
            <br>
            <label for="num_temporadas">Número de Temporadas:</label>
            <input type="text" name="num_temporadas" required>
            <br>
            <br>
            <label for="num_capitulos">Número de Capítulos:</label>
            <input type="text" name="num_capitulos" required>
            <br>
            <br>
            <button type="submit" name="accion" value="anadir_serie">Añadir Serie</button>
            <br>
            <br>
        </form>

        <!-- Campos para modificar una serie -->
        <form action="" method="post">
            <h3>Modificar Serie</h3>
            <label for="id_modificar_serie">Seleccionar serie:</label>
            <select name="id_modificar_serie" required>
                <?php
                // Cargar el contenido existente del archivo XML de series
                $xml_series = simplexml_load_file('contenido_series.xml');

                // Mostrar opciones de series en la caja desplegable
                foreach ($xml_series->serie as $serie) {
                    echo '<option value="' . $serie->id . '">' . $serie->id . ' - ' . $serie->titulo . '</option>';
                }
                ?>
            </select>
            <button type="submit" name="accion" value="mostrar_modificar_serie">Mostrar Detalles</button>
        </form>

        <form action="" method="post">
            <!-- Campos para eliminar una serie -->
            <h3>Eliminar Serie</h3>
            <label for="idEliminarSerie">Selecciona una serie a eliminar:</label>
            <select name="idEliminarSerie" required>
                <?php
                // Cargar el contenido existente del archivo XML de series
                $xml_series = simplexml_load_file('contenido_series.xml');

                // Mostrar opciones de series en el select
                foreach ($xml_series->serie as $serie) {
                    $id_serie = $serie->id;
                    $titulo_serie = $serie->titulo;
                    echo "<option value='$id_serie'>$id_serie - $titulo_serie</option>";
                }
                ?>
            </select>
            <br>
            <label for="confirmacion_serie">¿Estás seguro de eliminar la serie?</label>
            <select name="confirmacion_serie" required>
                <option value="si">Sí</option>
                <option value="no">No</option>
            </select>
            <br>
            <button type="submit" name="accion" value="eliminar_serie">Eliminar Serie</button>
        </form>
    </div>
    <?php
    // Acciones de gestión de series
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $accion_serie = $_POST["accion"];

        if ($accion_serie == "anadir_serie") {
            // Accion para añadir series
            $titulo_serie = $_POST["titulo"];
            $anio_estreno_serie = $_POST["anio_estreno"];
            $edad_recomendada_serie = $_POST["edad_recomendada"];
            $generos_serie = explode(",", $_POST["generos"]);
            $num_temporadas_serie = $_POST["num_temporadas"];
            $num_capitulos_serie = $_POST["num_capitulos"];

            // Validaciones
            if (!preg_match('/^\d{4}$/', $anio_estreno_serie)) {
                echo "<p>El año de estreno debe tener cuatro dígitos numéricos.</p>";
                exit();
            }

            if (!is_numeric($edad_recomendada_serie) || !is_numeric($num_temporadas_serie) || !is_numeric($num_capitulos_serie)) {
                echo "<p>La edad recomendada, el número de temporadas y el número de capítulos deben ser valores numéricos.</p>";
                exit();
            }

            // Verificar si el título ya existe en las series cargadas
            foreach ($xml_series->serie as $serie) {
                if ($serie->titulo == $titulo_serie) {
                    echo "<p>El título ya existe. Introduce un título único.</p>";
                    exit();
                }
            }

            // Generar un nuevo ID único
            $new_id = count($xml_series->serie) + 1;

            while (idExists($xml_series, $new_id)) {
                $new_id++;
            }

            // Crear un nuevo elemento serie
            $serie = $xml_series->addChild('serie');
            $serie->addChild('id', $new_id);
            $serie->addChild('titulo', $titulo_serie);
            $serie->addChild('anio_estreno', $anio_estreno_serie);
            $serie->addChild('edad_recomendada', $edad_recomendada_serie);

            // Añadir los géneros
            $generosElement = $serie->addChild('generos');
            foreach ($generos_serie as $genero) {
                $generosElement->addChild('genero', trim($genero));
            }

            $serie->addChild('num_temporadas', $num_temporadas_serie);
            $serie->addChild('num_capitulos', $num_capitulos_serie);

            // Guardar el nuevo contenido en el archivo XML de series
            $xml_series->asXML('contenido_series.xml');

            echo "<p>Serie añadida con éxito.</p>";

            header("Location: FGestionarContenidoSeries.php");
            exit();
        } elseif ($accion_serie == "mostrar_modificar_serie") {
            // Lógica para mostrar detalles y formulario de modificación de series
            $id_modificar_serie = $_POST['id_modificar_serie'];

            // Cargar el contenido existente del archivo XML de series
            $xml_series = simplexml_load_file('contenido_series.xml');

            // Buscar la serie con el ID seleccionado
            $serie = null;
            foreach ($xml_series->serie as $s) {
                if ((int)$s->id == $id_modificar_serie) {
                    $serie = $s;
                    break;
                }
            }

            // Verificar si se encontró la serie
            if ($serie !== null) {
                // Mostrar formulario de modificación con los datos obtenidos
                echo '<form method="post" action="">';
                echo 'Título: <input type="text" name="titulo" value="' . $serie->titulo . '"><br>';
                echo 'Año de Estreno: <input type="text" name="anio_estreno" value="' . $serie->anio_estreno . '"><br>';
                echo 'Edad Recomendada: <input type="text" name="edad_recomendada" value="' . $serie->edad_recomendada . '"><br>';
                echo 'Número de Temporadas: <input type="text" name="num_temporadas" value="' . $serie->num_temporadas . '"><br>';
                echo 'Número de Capítulos: <input type="text" name="num_capitulos" value="' . $serie->num_capitulos . '"><br>';
                echo '<input type="hidden" name="id" value="' . $id_modificar_serie . '">';
                echo '<button type="submit" name="accion" value="modificar_serie">Modificar Serie</button>';
                echo '</form>';
            } else {
                echo "No se encontró información para el ID seleccionado.";
            }
        } elseif ($accion_serie == "modificar_serie") {
            // Lógica para modificar series
            $id_modificar_serie = $_POST['id'];
            $titulo_serie = $_POST['titulo'];
            $anio_estreno_serie = $_POST['anio_estreno'];
            $edad_recomendada_serie = $_POST['edad_recomendada'];
            $num_temporadas_serie = $_POST['num_temporadas'];
            $num_capitulos_serie = $_POST['num_capitulos'];

            // Validaciones
            if (!preg_match('/^\d{4}$/', $anio_estreno_serie)) {
                echo "<p>El año de estreno debe tener cuatro dígitos numéricos.</p>";
                exit();
            }

            if (!is_numeric($edad_recomendada_serie) || !is_numeric($num_temporadas_serie) || !is_numeric($num_capitulos_serie)) {
                echo "<p>La edad recomendada, el número de temporadas y el número de capítulos deben ser valores numéricos.</p>";
                exit();
            }

            // Cargar el contenido existente del archivo XML de series
            $xml_series = simplexml_load_file('contenido_series.xml');

            // Buscar la serie con el ID seleccionado
            $serie = null;
            foreach ($xml_series->serie as $s) {
                if ((int)$s->id == $id_modificar_serie) {
                    $serie = $s;
                    break;
                }
            }

            // Verificar si se encontró la serie
            if ($serie !== null) {
                // Actualizar los valores de la serie
                $serie->titulo = $titulo_serie;
                $serie->anio_estreno = $anio_estreno_serie;
                $serie->edad_recomendada = $edad_recomendada_serie;
                $serie->num_temporadas = $num_temporadas_serie;
                $serie->num_capitulos = $num_capitulos_serie;

                // Guardar los cambios en el archivo XML de series
                $xml_series->asXML('contenido_series.xml');

                echo "<p>Serie modificada con éxito.</p>";
            } else {
                echo "No se encontró información para el ID seleccionado.";
            }
        } elseif ($accion_serie == "eliminar_serie") {
            // Lógica para eliminar series
            $idEliminarSerie = $_POST["idEliminarSerie"];
            $confirmacion_serie = $_POST["confirmacion_serie"];

            if ($confirmacion_serie == "si") {
                // Cargar el contenido existente del archivo XML de series
                $xml_series = simplexml_load_file('contenido_series.xml');

                // Buscar la serie con el ID proporcionado
                $serieEliminar = $xml_series->xpath("//serie[id=$idEliminarSerie]");

                // Eliminar la serie si se encuentra
                if (!empty($serieEliminar)) {
                    // Usar unset junto con xpath para eliminar el elemento correctamente
                    unset($serieEliminar[0][0]);

                    // Guardar los cambios en el archivo XML de series
                    $xml_series->asXML('contenido_series.xml');
                    echo "<p>Serie eliminada con éxito.</p>";
                } else {
                    echo "<p>No se encontró ninguna serie con el ID proporcionado.</p>";
                }
            } else {
                echo "<p>Eliminación cancelada.</p>";
            }
        }
    }
     // Función para verificar si un ID existe en las series
     function idExists($xml_series, $id)
     {
         foreach ($xml_series->serie as $serie) {
             if ((int)$serie->id == $id) {
                 return true;
             }
         }
         return false;
     }
    ?>
        <a href="javascript:history.back()" class="boton">Volver</a>

</body>

</html>
