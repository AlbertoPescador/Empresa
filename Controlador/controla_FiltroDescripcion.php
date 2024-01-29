<?php
// Inicia o reanuda la sesión
session_start();

include_once "../Modelo/ProductoDB.php";
include_once "../Modelo/ProveedorDB.php";

// Verifica si se ha enviado el formulario de filtrado por descripción
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera el valor de la descripción del formulario
    $descripcion = $_POST["descripcion"];

    // Recupera el código del proveedor actual de la sesión
    $codigoProveedor = $_SESSION['codigo'];

    // Obtiene el objeto Proveedor usando el código
    $proveedor = ProveedorDB::getProveedor($codigoProveedor);

    // Inicializa la lista de productos
    $productos = [];

    try {
        // Lista de productos filtrados por descripción
        $productos = ProductoDB::getByDescripcionAndProveedor($proveedor, $descripcion);

        if (empty($productos)) {
            echo "<p>No se encontraron productos con la descripción especificada.</p>";
        } else {
            // Muestra la tabla de productos
            echo "<table>";
            echo "<tr><th>Código</th><th>Descripción</th><th>Precio</th><th>Stock</th></tr>";

            foreach ($productos as $producto) {
                echo "<tr>";
                echo "<td>" . $producto->getCodigo() . "</td>";
                echo "<td>" . $producto->getDescripcion() . "</td>";
                echo "<td>" . $producto->getPrecio() . "</td>";
                echo "<td>" . $producto->getStock() . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        }
    } catch (Exception $e) {
        echo "Error al filtrar productos: " . $e->getMessage();
    }
} else {
    // Redirige a la página de filtrado si no se recibieron los datos correctamente
    header("Location: ../Vista/form_ByDescription.php");
    exit();
}
?>