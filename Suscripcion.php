<?php

    include_once("Usuario.php");
    include_once("Peliculas.php");
    include_once("Series.php");
    
    class Suscripcion {

        //Atributos
        private int $codigo;
        private string $descripcion;
        private float $precio;
        private array $lista_multimedia;
        private array $lista_usuarios;


        //Constructor
        public function __construct(int $codigo, string $descripcion,$precio, array $lista_multimedia,  array $lista_usuarios) {
            $this->codigo = $codigo;
            $this->descripcion = $descripcion;
            $this->precio = $precio;
            $this->lista_multimedia = $lista_multimedia;
            $this->lista_usuarios = $lista_usuarios;
        }


        //Metodos Getters
        public function getCodigo() {
            return $this->codigo;
        }

        public function getDescripcion() {
            return $this->descripcion;
        }

        public function getprecio() {
            return $this->precio;
        }

        public function getListaMultimedia() {
            return $this->lista_multimedia;
        }

        public function getlista_usuarios() {
            return $this->lista_usuarios;
        }

        //Metodos Setters

        public function setCodigo(int $codigo) {
            $this->codigo = $codigo;
        }

        public function setDescripcion(string $descripcion) {
            $this->descripcion = $descripcion;
        }

        public function setprecio(string $precio) {
            $this->precio = $precio;
        }

        public function setListaMultimedia(array $lista_multimedia) {
            $this->lista_multimedia = $lista_multimedia;
        }

        public function setlista_usuarios(array $lista_usuarios){
            $this->lista_usuarios = $lista_usuarios;
        }

        //Funcion para añadir/crear usuarios
        public function addUsuario(array $usuarios){
            // Verificar si el nombre de usuario ya existe
            foreach ($usuarios as $usuarioExistente) {
                if ($usuarioExistente->getNombreUsuario() === $this->nombre_usuario) {
                    return false; // El nombre de usuario ya existe, no se puede agregar
                }
            }
            // Si el nombre de usuario no existe, agregar el usuario
            $usuarios[] = $this;
            return true; // Usuario agregado con éxito
    
        }

        //Funcion para eliminar usuarios
        public function rmusuario(array $usuarios){
            foreach ($usuarios as $key => $usuarioExistente) {
                if ($usuarioExistente->getNombreUsuario() === $this->nombre_usuario) {
                    unset($usuarios[$key]); // Eliminar el usuario del array
                    return true; // Usuario eliminado con éxito
                }
            }
    
            return false; // El usuario no existe en el array
        }

        //Funcion para Modificar usuario
        public function mvUsuario(array $usuarios, string $nuevoNombreUsuario, string $nuevaPassword, string $nuevoEmail, string $nuevoNombre
        ){
            foreach ($usuarios as $key => $usuarioExistente) {
                if ($usuarioExistente->getNombreUsuario() === $this->nombre_usuario) {
                    unset($usuarios[$key]); // Eliminar el usuario del array
                    return true; // Usuario eliminado con éxito
                }
            }
    
            return false; // El usuario no existe en el array
        }

        //Funcion para Actualizar Usuario
        public function UpUsuario(array $usuarios, ?string $nuevoNombreUsuario = null, ?string $nuevaPassword = null, ?string $nuevoEmail = null, ?string $nuevoNombre = null){
            foreach ($usuarios as $key => $usuarioExistente) {
                if ($usuarioExistente->getNombreUsuario() === $this->nombre_usuario) {
                    // Actualizar solo los atributos proporcionados
                    if ($nuevoNombreUsuario !== null) {
                        $usuarios[$key]->setNombreUsuario($nuevoNombreUsuario);
                    }
    
                    if ($nuevaPassword !== null) {
                        $usuarios[$key]->setPassword($nuevaPassword);
                    }
    
                    if ($nuevoEmail !== null) {
                        $usuarios[$key]->setEmail($nuevoEmail);
                    }
    
                    if ($nuevoNombre !== null) {
                        $usuarios[$key]->setNombre($nuevoNombre);
                    }
    
                    return true; // Usuario actualizado con éxito
                }
            }
    
            return false; // El usuario no existe en el array
        }

        public function addPelicula(int $id, string $titulo, string $aniopelicula, int $edad_recomendada, int $duracion) {
            $pelicula = new Peliculas($id, $titulo, $aniopelicula, $edad_recomendada, $duracion);
            $this->lista_multimedia[] = $pelicula;
        }
    
        public function rmPelicula(int $id) {
            foreach ($this->lista_multimedia as $key => $multimedia) {
                if ($multimedia instanceof Peliculas && $multimedia->getId() === $id) {
                    unset($this->lista_multimedia[$key]);
                    return true; // Película eliminada con éxito
                }
            }
            return false; // La película no existe en la lista
        }
    
        public function mvPelicula(int $id, ?string $nuevoTitulo = null, ?string $nuevoAnioPelicula = null, ?int $nuevaEdadRecomendada = null, ?int $nuevaDuracion = null) {
            foreach ($this->lista_multimedia as $key => $multimedia) {
                if ($multimedia instanceof Peliculas && $multimedia->getId() === $id) {
                    // Actualizar solo los atributos proporcionados
                    if ($nuevoTitulo !== null) {
                        $multimedia->setTitulo($nuevoTitulo);
                    }
    
                    if ($nuevoAnioPelicula !== null) {
                        $multimedia->setAnioPelicula($nuevoAnioPelicula);
                    }
    
                    if ($nuevaEdadRecomendada !== null) {
                        $multimedia->setEdadRecomendada($nuevaEdadRecomendada);
                    }
    
                    if ($nuevaDuracion !== null) {
                        $multimedia->setDuracion($nuevaDuracion);
                    }
    
                    return true; // Película actualizada con éxito
                }
            }
    
            return false; // La película no existe en la lista
        }

        // Operaciones CRUD para Series
        public function agregarSerie(Series $serie) {
            $this->lista_series[] = $serie;
        }

        public function obtenerSeriePorId(int $id) {
            foreach ($this->lista_series as $serie) {
                if ($serie->getId() === $id) {
                    return $serie;
                }
            }
            return false; // Serie no encontrada
        }

        public function actualizarSerie(Series $serie) {
            foreach ($this->lista_series as $key => $existingSerie) {
                if ($existingSerie->getId() === $serie->getId()) {
                    $this->lista_series[$key] = $serie;
                    return true; // Serie actualizada con éxito
                }
            }
            return false; // Serie no encontrada
        }

        public function eliminarSeriePorId(int $id) {
            foreach ($this->lista_series as $key => $serie) {
                if ($serie->getId() === $id) {
                    unset($this->lista_series[$key]);
                    return true; // Serie eliminada con éxito
                }
            }
            return false; // Serie no encontrada
        }

        //Metodo toString
        public function toString() {
            return "ID: {$this->id}, Título: {$this->titulo}, Año: {$this->aniopelicula}, Edad Recomendada: {$this->edad_recomendada}, Duración: {$this->duracion} minutos";
        }

        
        
    }
?>