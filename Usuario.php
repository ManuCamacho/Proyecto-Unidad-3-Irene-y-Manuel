<?php

    class Usuario{
        //Atributos
        private string $nombre_usuario;
        private string $password;
        private string $email;
        private string $nombre;
        private bool $suscripcion;

        //Constructor
        public function __construct(string $nombre_usuario, string $password, string $email, string $nombre){
            $this->nombre_usuario = $nombre_usuario;
            $this->password = $password;
            $this->email = $email;
            $this->nombre = $nombre;
        }

        //Metodos Getters

        public function getNombreUsuario(){
            return $this->nombre_usuario;
        }

        public function getPassword(){
            return $this->password;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getNombre(){
            return $this->nombre;
        }

        //Metodos Setters

        public function setNombreUsuario($nombre_usuario){
            $this->nombre_usuario = $this->nombre_usuario;
        }

        public function setPassword($password){
            $this->password = $password;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }

        //Metodo toString

        public function __toString(){
            return $this->nombre_usuario."<br>" .$this->password."<br>" .$this->email."<br>" .$this->nombre;
        }
    }


?>