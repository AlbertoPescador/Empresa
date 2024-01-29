<?php
    function mostrarProductos(){

        include_once "../Modelo/ProductoDB.php";
        include_once "../Modelo/ProveedorDB.php";
        include_once "../Modelo/Producto.php";

        // Verificar si la sesión está iniciada
        if (!isset($_SESSION['codigo'])) {
            header("Location: ../Vista/form_Login.php");
            exit();
        }

        // Obtener la información del proveedor de la sesión
        $codigo_proveedor = $_SESSION['codigo'];
        $proveedor = ProveedorDB::getProveedor($codigo_proveedor);

        // Inicializar $productos como un array vacío
        $productos = [];

        try {    
            $productos = ProductoDB::getAll($proveedor);
            // Imprimir lista de productos
            foreach ($productos as $producto) {
                echo "Código: " . $producto->getCodigo() . "<br>";
                echo "Descripción: " . $producto->getDescripcion() . "<br>";
                echo "Precio: " . $producto->getPrecio() . "<br>";
                echo "Stock: " . $producto->getStock() . "<br>";
                echo "-----------------------------<br>";
            }
        } catch (Exception $e) {
            echo "Error al obtener productos: " . $e->getMessage();
        }
    }
?>