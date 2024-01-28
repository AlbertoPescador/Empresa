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

// Verifica si se ha enviado el formulario de filtrado por descripción
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera la descripción del formulario
    $descripcion = $_POST["descripcion"];

    try {
        // Lista de productos filtrados por descripción y proveedor
        $productos = ProductoDB::getByDescripcionAndProveedor($descripcion, $proveedor);

        echo "<h2>Productos con descripción que contiene '$descripcion'</h2>";

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
    header("Location: ../Vista/form_FiltroDescripcion.php");
    exit();
}
?>