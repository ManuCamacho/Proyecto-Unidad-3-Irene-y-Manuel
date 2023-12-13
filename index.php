<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Multimedia</title>
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body>

<div class="container">
    <h2>Formulario Multimedia</h2>

    <form action="index.php" method="post">
        <input type="submit" value="Registro" id="registro" name="registro_btn">
        <input type="submit" value="Acceder" id="acceder" name="acceso_btn">
    </form>
</div>

<?php
if (isset($_POST['registro_btn'])) {
    header("Location: fregistro.php");
    exit();
}

if (isset($_POST['acceso_btn'])) {
    header("Location: fInicioSesion.php");
    exit();
}
?>

</body>
</html>
