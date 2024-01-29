<?php
    // Inicia o reanuda la sesión
    session_start();

    include_once "../Modelo/ProductoDB.php";
    include_once "../Modelo/ProveedorDB.php";

    // Verifica si el proveedor está autenticado
    if (!isset($_SESSION['codigo'])) {
        // Si el proveedor no está autenticado, redirige a la página de inicio de sesión
        header("Location: ../Vista/form_Login.php");
        exit();
    }

    // Recupera el código del proveedor actual de la sesión
    $codigoProveedor = $_SESSION['codigo'];

    // Obtiene el objeto Proveedor usando el código
    $proveedor = ProveedorDB::getProveedor($codigoProveedor);

    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera los datos del formulario
        $codigo = $_POST["codigo"];
        $descripcion = $_POST["descripcion"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];

        // Crea un objeto Producto con los datos del formulario
        $producto = new Producto($codigo, $descripcion, $precio, $stock);

        // Intenta agregar el producto utilizando la función add
        $productoAgregado = ProductoDB::add($producto, $proveedor);

        if ($productoAgregado) {
            // Producto eliminado
            echo '<script>alert("El producto fue añadido correctamente");</script>';
            echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
        } else {
            echo '<script>alert("Error al añadir el producto");</script>';
            echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
        }
    }
?>