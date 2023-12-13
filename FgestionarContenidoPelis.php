<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Contenido: Películas</title>
    <link rel="stylesheet" type="text/css" href="FGestionarContenidoPelis.css">

</head>
<body>
<h2>Gestionar Contenido: Películas</h2>

<div class="forms-container">
<form action="" method="post">
    <!-- Campos para agregar una película -->
    <h3>Añadir Pelicula</h3>
    <label for="titulo">Título:</label>
    <input type="text" name="titulo" required>
    
    <label for="aniopelicula">Año de la película:</label>
    <input type="text" name="aniopelicula" required>
    
    <label for="edad_recomendada">Edad Recomendada:</label>
    <input type="text" name="edad_recomendada" required>
  
    <label for="generos">Géneros (separados por comas):</label>
    <input type="text" name="generos" required>
    
    <label for="duracion">Duración:</label>
    <input type="text" name="duracion" required>
    
    <label for="tipo">Tipo:</label>
    <select name="tipo" required>
        <option value="pelis">Película</option>
    </select>
   
    <button type="submit" name="accion" value="anadir">Añadir</button>
    
    </form>
    
    <!-- Campos para modificar una película -->
    <form action="" method="post">
        <h3>Modificar Pelicula</h3>
        <label for="id_modificar">Seleccionar película:</label>
        <select name="id_modificar" required>
            <?php
            // Cargar el contenido existente del archivo XML
            $xml = simplexml_load_file('contenido.xml');

            // Mostrar opciones de películas en la caja desplegable
            foreach ($xml->pelicula as $p) {
                echo '<option value="' . $p->id . '">' . $p->id . ' - ' . $p->titulo . '</option>';
            }
            ?>
        </select>
        <button type="submit" name="accion" value="mostrar_modificar">Mostrar Detalles</button>
    </form>
        
    <form action="" method="post">
    <!-- Campos para eliminar una película -->
    <h3>Eliminar Película</h3>
    <label for="idEliminar">Selecciona una película a eliminar:</label>
    <select name="idEliminar" required>
        <?php
        // Cargar el contenido existente del archivo XML
        $xml = simplexml_load_file('contenido.xml');

        // Mostrar opciones de películas en el select
        foreach ($xml->pelicula as $pelicula) {
            $id = $pelicula->id;
            $titulo = $pelicula->titulo;
            echo "<option value='$id'>$id - $titulo</option>";
        }
        ?>
    </select>
    
    <label for="confirmacion">¿Estás seguro de eliminar la película?</label>
    <select name="confirmacion" required>
        <option value="si">Sí</option>
        <option value="no">No</option>
    </select>
    
    <button type="submit" name="accion" value="eliminar">Eliminar</button>
</form>
</div>

<?php

// Acciones de gestión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"];

    if ($accion == "anadir") {
        // Accion para añadir películas
        $tipo = $_POST["tipo"];
        if ($tipo == "pelis") {
            // Obtener datos del formulario
            $titulo = $_POST["titulo"];
            $aniopelicula = $_POST["aniopelicula"];
            $edad_recomendada = $_POST["edad_recomendada"];
            $duracion = $_POST["duracion"];
            $generos = explode(",", $_POST["generos"]); // Suponiendo que los géneros se ingresan como una cadena separada por comas

            // Validar campos obligatorios y formatos
            if (empty($titulo) || empty($aniopelicula) || empty($edad_recomendada) || empty($duracion)) {
                echo "<p>Error: Todos los campos son obligatorios.</p>";
            } elseif (!is_numeric($aniopelicula) || strlen($aniopelicula) !== 4) {
                echo "<p>Error: El año debe ser un valor numérico de 4 dígitos.</p>";
            } elseif (!is_numeric($edad_recomendada)) {
                echo "<p>Error: La edad recomendada debe ser un valor numérico.</p>";
            } elseif (!is_numeric($duracion)) {
                echo "<p>Error: La duración debe ser un valor numérico.</p>";
            } else {
                // Cargar el contenido existente del archivo XML
                $xml = simplexml_load_file('contenido.xml');

                // Crear un nuevo elemento película
                $pelicula = $xml->addChild('pelicula');
                $pelicula->addChild('id', count($xml->pelicula) + 1); // Asignar un nuevo ID
                $pelicula->addChild('titulo', $titulo);
                $pelicula->addChild('aniopelicula', $aniopelicula);
                $pelicula->addChild('edad_recomendada', $edad_recomendada);
                $pelicula->addChild('duracion', $duracion);

                // Añadir los géneros
                $generosElement = $pelicula->addChild('generos');
                foreach ($generos as $genero) {
                    $generosElement->addChild('genero', trim($genero)); // trim elimina los espacios en blanco
                }

                // Guardar el nuevo contenido en el archivo XML
                $xml->asXML('contenido.xml');

                echo "<p>Película añadida con éxito.</p>";

                header("Location: FgestionarContenidoPelis.php");
                exit();
            }
        }
    
    
    } elseif ($accion == "mostrar_modificar") {
        // Obtener el ID seleccionado
        $id_modificar = $_POST['id_modificar'];

        // Cargar el contenido existente del archivo XML
        $xml = simplexml_load_file('contenido.xml');

        // Buscar la película con el ID seleccionado
        $pelicula = null;
        foreach ($xml->pelicula as $p) {
            if ((int)$p->id == $id_modificar) {
                $pelicula = $p;
                break;
            }
        }

        // Verificar si se encontró la película
        if ($pelicula !== null) {
            // Mostrar formulario de modificación con los datos obtenidos
            echo '<form method="post" action="">';
            echo 'Título: <input type="text" name="titulo" value="' . $pelicula->titulo . '"><br>';
            echo 'Año de la película: <input type="text" name="aniopelicula" value="' . $pelicula->aniopelicula . '"><br>';
            echo 'Edad Recomendada: <input type="text" name="edad_recomendada" value="' . $pelicula->edad_recomendada . '"><br>';
            echo 'Duración: <input type="text" name="duracion" value="' . $pelicula->duracion . '"><br>';
            echo '<input type="hidden" name="id" value="' . $id_modificar . '">';
            echo '<button type="submit" name="accion" value="modificar">Modificar</button>';
            echo '</form>';
        } else {
            echo "No se encontró información para el ID seleccionado.";
        }
    } elseif ($accion == "mostrar_modificar") {
        // Obtener el ID seleccionado
        $id_modificar = $_POST['id_modificar'];
    
        // Cargar el contenido existente del archivo XML
        $xml = simplexml_load_file('contenido.xml');
    
        // Buscar la película con el ID seleccionado
        $pelicula = null;
        foreach ($xml->pelicula as $p) {
            if ((int)$p->id == $id_modificar) {
                $pelicula = $p;
                break;
            }
        }
    
        // Verificar si se encontró la película
        if ($pelicula !== null) {
            // Mostrar formulario de modificación con los datos obtenidos
            echo '<form method="post" action="">';
            echo 'Título: <input type="text" name="titulo" value="' . $pelicula->titulo . '"><br>';
            echo 'Año de la película: <input type="text" name="aniopelicula" value="' . $pelicula->aniopelicula . '"><br>';
            echo 'Edad Recomendada: <input type="text" name="edad_recomendada" value="' . $pelicula->edad_recomendada . '"><br>';
            echo 'Duración: <input type="text" name="duracion" value="' . $pelicula->duracion . '"><br>';
            echo '<input type="hidden" name="id" value="' . $id_modificar . '">';
            echo '<button type="submit" name="accion" value="modificar">Modificar</button>';
            echo '</form>';
        } else {
            echo "No se encontró información para el ID seleccionado.";
        }
    } elseif ($accion == "modificar") {
        // Obtener los datos del formulario de modificación
        $id_modificar = $_POST['id'];
        $titulo = $_POST['titulo'];
        $aniopelicula = $_POST['aniopelicula'];
        $edad_recomendada = $_POST['edad_recomendada'];
        $duracion = $_POST['duracion'];
    
        // Validar campos obligatorios y formatos
        if (empty($titulo) || empty($aniopelicula) || empty($edad_recomendada) || empty($duracion)) {
            echo "<p>Error: Todos los campos son obligatorios.</p>";
        } elseif (!is_numeric($aniopelicula) || strlen($aniopelicula) !== 4) {
            echo "<p>Error: El año debe ser un valor numérico de 4 dígitos.</p>";
        } elseif (!is_numeric($edad_recomendada)) {
            echo "<p>Error: La edad recomendada debe ser un valor numérico.</p>";
        } elseif (!is_numeric($duracion)) {
            echo "<p>Error: La duración debe ser un valor numérico.</p>";
        } else {
            // Cargar el contenido existente del archivo XML
            $xml = simplexml_load_file('contenido.xml');
    
            // Buscar la película con el ID seleccionado
            $pelicula = null;
            foreach ($xml->pelicula as $p) {
                if ((int)$p->id == $id_modificar) {
                    $pelicula = $p;
                    break;
                }
            }
    
            // Verificar si se encontró la película
            if ($pelicula !== null) {
                // Actualizar los valores de la película
                $pelicula->titulo = $titulo;
                $pelicula->aniopelicula = $aniopelicula;
                $pelicula->edad_recomendada = $edad_recomendada;
                $pelicula->duracion = $duracion;
    
                // Guardar los cambios en el archivo XML
                $xml->asXML('contenido.xml');
    
                echo "<p>Película modificada con éxito.</p>";
            } else {
                echo "No se encontró información para el ID seleccionado.";
            }
        }
    
    
    } elseif ($accion == "eliminar") {
        // Lógica para eliminar contenido según el tipo (películas)
        $idEliminar = $_POST["idEliminar"];
        $confirmacion = $_POST["confirmacion"];

        if ($confirmacion == "si") {
            // Cargar el contenido existente del archivo XML
            $xml = simplexml_load_file('contenido.xml');

            // Buscar la película con el ID proporcionado
            $peliculaEliminar = $xml->xpath("//pelicula[id=$idEliminar]");

            // Eliminar la película si se encuentra
            if (!empty($peliculaEliminar)) {
                // Usar unset junto con xpath para eliminar el elemento correctamente
                unset($peliculaEliminar[0][0]);

                // Guardar los cambios en el archivo XML
                $xml->asXML('contenido.xml');
                echo "<p>Película eliminada con éxito.</p>";
            } else {
                echo "<p>No se encontró ninguna película con el ID proporcionado.</p>";
            }
        } else {
            echo "<p>Eliminación cancelada.</p>";
        }
    }
}
?>
    <a href="javascript:history.back()" class="boton">Volver</a>

</body>
</html>
