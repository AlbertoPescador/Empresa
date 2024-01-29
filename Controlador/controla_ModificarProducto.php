<?php
// Inicia o reanuda la sesión
session_start();

include_once "../Modelo/ProductoDB.php";
include_once "../Modelo/ProveedorDB.php";

// Verifica si se ha enviado el formulario de modificación
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recupera el código del producto a modificar si está presente
    $codigoProducto = isset($_POST["codigomodif"]) ? $_POST["codigomodif"] : null;

    if ($codigoProducto !== null) {
        // Recupera el código del proveedor actual de la sesión
        $codigoProveedor = $_SESSION['codigo'];

        // Obtiene el objeto Proveedor usando el código
        $proveedor = ProveedorDB::getProveedor($codigoProveedor);

        $datosProducto = ProductoDB::getByCodigo($codigoProducto);

        if(ProductoDB::update($datosProducto, $proveedor)) {
            // Modificación de producto completa, redirigir a la página de inicio
            echo '<script>alert("Se ha modificado correctamente!!");</script>';
            echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
            exit();
        } else {
            // Error en la modificación, mostrar mensaje o redirigir a página de error
            echo '<script>alert("Error al modificar el producto.");</script>';
            echo '<script>window.location.href="../Vista/form_ModificarProducto.php";</script>';
            exit();
        }
    } else {
        // Redirige a la página de modificación si no se recibieron los datos correctamente
        echo '<script>alert("Error: Código de producto no recibido.");</script>';
        echo '<script>window.location.href="../Vista/form_ModificarProducto.php";</script>';
        exit();
    }
}
?>