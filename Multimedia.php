<?php

//Enumeracion para definir los valores de genero.
enum genero {
    case Accion;
    case terror;
    case animacion;
    case comedia;

};
class Multimedia{
    //Atributos
    private int $id;
    private string $titulo;
    private string $aniopelicula;
    private int $edad_recomendada;
    private Genero $genero;


    //Contructor
    public function __construct(int $id, string $titulo, string $aniopelicula, int $edad_recomendada, genero $genero){
        $this->id = $id;
        $this->titulo = $titulo;
        $this->aniopelicula =  $aniopelicula;
        $this->edad_recomendada = $edad_recomendada;
        $this->genero= $genero;
     
    }

    //Metodos Getters
    public function getId(){
        return $this->id;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function getAniopelicula(){
        return $this->aniopelicula;
    }
    public function getEdadRecomendada(){
        return $this->edad_recomendada;
    }
    public function getGeneros() {
        return self::genero;
    }

    //Metodos Setters
    public function setId(int $id){
        $this->id = $id;
    }
    public function setTitulo(string $titulo){
        $this->titulo = $titulo;
    }
    public function setAniopelicula(int $aniopelicula){
        $this->aniopelicula = $aniopelicula;
    }
    public function setEdadRecomendada(int $edadRecomendada){
        $this->edad_recomendada = $edadRecomendada;
    }
    
    public function setGeneros(int $generos){
        $this->generos = $generos;
    }

    //Metodo toString
    public function __toString(){
        return "Id: ". $this->id ."Titulo: ".$this->titulo."Año de la pelicula: ".$this->aniopelicula."Edad recomendada: ".$this->edad_recomendada;
    }
}


?>