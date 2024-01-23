<?php
    class Proveedor{
        //  Atributos de la clase
        private string $codigo;
        private string $password;
        private int $telefono;
        private string $nombre;
        private string $apellidos;
        private $misProductos = miArray();

        //  Propiedades
        //  Atributo -> codigo
        //  Get
        public function getCodigo()
        {
            return $this->codigo;
        }
        //  Set
        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;

            return $this;
        }

        //  Atributo -> password
        //  Get
        public function getPassword()
        {
            return $this->password;
        }
        //  Set
        public function setPassword($password)
        {
            $this->password = $password;

            return $this;
        }

        //  Atributo -> telefono
        //  Get
        public function getTelefono()
        {
            return $this->telefono;
        }
        //  Set
        public function setTelefono($telefono)
        {
            $this->telefono = $telefono;

            return $this;
        }

        //  Atributo -> nombre
        //  Get
        public function getNombre()
        {
            return $this->nombre;
        }
        //  Set
        public function setNombre($nombre)
        {
            $this->nombre = $nombre;

            return $this;
        }

        //  Atributo -> apellidos
        //  Get
        public function getApellidos()
        {
            return $this->apellidos;
        }  
        //  Set
        public function setApellidos($apellidos)
        {
            $this->apellidos = $apellidos;

            return $this;
        }
        
        //  Atributo -> misProductos
        //  Get
        public function getMisProductos()
        {
            return $this->misProductos;
        }
        //  Set
        public function setMisProductos($misProductos)
        {
            $this->misProductos = $misProductos;

            return $this;
        }
        
    }
?>