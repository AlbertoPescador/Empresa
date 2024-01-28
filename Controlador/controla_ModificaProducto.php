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

// Verifica si se ha enviado el formulario de modificación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["codigomodif"])) {
    // Recupera el código del producto a modificar
    $codigoProducto = $_POST["codigo"];

    // Obtiene el objeto Producto usando el código
    $producto = ProductoDB::getByCodigo($codigoProducto);

    if ($producto) {
        // Redirige a la página de modificación
        header("Location: ../Vista/form_ModificarProducto.php?codigo=$codigoProducto");
        exit();
    } else {
        // Si el producto no existe, redirige a la página de modificación
        header("Location: ../Vista/form_ModificarProducto.php");
        exit();
    }
} else {
    // Redirige a la página de modificación si no se recibieron los datos correctamente
    header("Location: ../Vista/form_ModificarProducto.php");
    exit();
}
?>
