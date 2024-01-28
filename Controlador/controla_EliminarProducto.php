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
    // Recupera el código del producto a eliminar
    $codigoProducto = $_POST["codigo"];

    // Verifica si el producto existe por descripción y código antes de eliminar
    if (ProductoDB::getByDescripcionAndProveedor($proveedor, $descripcion)) {
        // Intenta eliminar el producto utilizando la función delete
        $productoEliminado = ProductoDB::deleteByCodigo($codigoProducto);

        if ($productoEliminado) {
            // Producto eliminado
            echo '<script>alert("El producto fue eliminado correctamente");</script>';
            echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
        } else {
            echo '<script>alert("Error al eliminar el producto");</script>';
            echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
        }
    } else {
        // El producto no existe
        echo '<script>alert("El producto no existe");</script>';
        echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
    }
}
?>
