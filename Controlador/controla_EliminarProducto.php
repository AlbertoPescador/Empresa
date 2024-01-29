<?php
// Inicia o reanuda la sesión
session_start();

include_once "../Modelo/ProductoDB.php";
include_once "../Modelo/ProveedorDB.php";

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera el código del proveedor actual de la sesión
    $codigoProveedor = $_SESSION['codigo'];

    // Obtiene el objeto Proveedor usando el código
    $proveedor = ProveedorDB::getProveedor($codigoProveedor);

    // Recupera el código del producto a eliminar
    $codigoProducto = $_POST["codigo"];

    // Obtiene el objeto Producto usando el código
    $productoExistente = ProductoDB::getByCodigo($codigoProducto);

    if ($productoExistente) {
        // Verifica si el producto pertenece al proveedor actual
        if ($productoExistente->getMiProveedor() == $codigoProveedor) {
            // Intenta eliminar el producto utilizando la función delete
            $productoEliminado = ProductoDB::deleteByCodigo($productoExistente);

            if ($productoEliminado) {
                // Producto eliminado
                echo '<script>alert("El producto fue eliminado correctamente");</script>';
                echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
            } else {
                echo '<script>alert("Error al eliminar el producto");</script>';
                echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
            }
        } else {
            // El producto no pertenece al proveedor actual
            echo '<script>alert("El producto no pertenece al proveedor actual");</script>';
            echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
        }
    } else {
        // El producto no existe
        echo '<script>alert("El producto no existe");</script>';
        echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
    }
}
?>
