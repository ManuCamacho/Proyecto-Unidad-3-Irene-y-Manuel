<?php
    include_once "Multimedia.php";
    //La clase series herada de la clase multimedia.
    class Series extends Multimedia{
        //Atributos 
        private int $cod;
        private int $temporadas;
        private int $num_capitulos;
        private int $duracion_capitulos;

        //Constructor

        public function construct(int $id, string $titulo, string $aniopelicula, int $edad_recomendada, genero $genero, int $temporadas, int $num_capitulos, int $duracion_capitulos) {
            parent::construct($id, $titulo,$aniopelicula,$edad_recomendada, $genero);
            /* $this->cod = $cod; */
            $this->temporadas = $temporadas;
            $this->num_capitulos = $num_capitulos;
            $this->duracion_capitulos = $duracion_capitulos;
        }

        //Metodos Getters

        public function getCod(){
            return $this->cod;
        }

        public function getTemporadas() {
            return $this->temporadas;
        }

        public function getNumCapitulos() {
            return $this->num_capitulos;
        }

        public function getDuracionCapitulos() {
            return $this->duracion_capitulos;
        }

        //Metodos Setters

        public function setId(int $cod){
            $this->cod = $cod;
        }

        public function setTemporadas(int $temporadas) {
            $this->temporadas = $temporadas;
        }

        public function setNumCapitulos(int $num_capitulos) {
            $this->num_capitulos = $num_capitulos;
        }

        public function setDuration(int $duracion_capitulos) {
            $this->duracion_capitulos = $duracion_capitulos;
        }

        //Metodo toString
        public function __toString(): string {
            return $this->temporadas ."<br>" .$this->num_capitulos."<br>" .$this->duracion_capitulos ;
        }
    }

?>