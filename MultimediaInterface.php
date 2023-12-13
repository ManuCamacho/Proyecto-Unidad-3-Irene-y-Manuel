<?php

interface MultimediaInterface {
    public function readMultimedia();
    public function upMultimedia(string $nuevoTitulo, string $nuevoAnio, int $nuevaEdadRecomendada, array $nuevoGenero);
    public function rmMultimediaGenero(string $generoEliminar);
}

?>
