<?php
    class Producto{
        //  Atributos de la clase
        private string $codigo;
        private string $descripcion;
        private float $precio;
        private int $stock;
        private Proveedor $miProveedor;

        // Constructor
        public function __construct(string $codigo, string $descripcion, float $precio, int $stock) {
                $this->codigo = $codigo;
                $this->descripcion = $descripcion;
                $this->precio = $precio;
                $this->stock = $stock;
        }

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

        //  Atributo -> descripcion
        //  Get
        public function getDescripcion()
        {
                return $this->descripcion;
        }
        //  Set
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }

        //  Atributo -> precio
        //  Get
        public function getPrecio()
        {
                return $this->precio;
        }
        //  Set
        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }

        //  Atributo -> stock
        //  Get
        public function getStock()
        {
                return $this->stock;
        }
        //  Set
        public function setStock($stock)
        {
                $this->stock = $stock;

                return $this;
        }

        //  Atributo -> miProveedor
        //  Get
        public function getMiProveedor()
        {
                return $this->miProveedor;
        }
        //  Set
        public function setMiProveedor($miProveedor)
        {
                $this->miProveedor = $miProveedor;

                return $this;
        }
    }
?>