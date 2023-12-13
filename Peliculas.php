<?php
include_once "Multimedia.php";

    //La clase series herada de la clase multimedia.

class Peliculas extends Multimedia{
    //Atributos
    private int $cod;
    private int $duracion;

    //Contructor
    public function __construct(int $id, string $titulo, string $aniopelicula, int $edad_recomendada,int $cod, int $duracion){
        parent::__construct( $id, $titulo, $aniopelicula, $edad_recomendada);
        $this->cod = $cod;
        $this->duracion = $duracion;

    }
    //Metodo Get
    public function getDuracion(){
        return $this->duracion;
    }

    //Metodo Set
    public function setDuracion(int $duracion){
        $this->duracion = $duracion;
    }

    //Metodo toString
    public function __toString(){
        return parent::__toString() . "Código: " . $this->cod . "Duración: " . $this->duracion."<br>";
    }
}
?>