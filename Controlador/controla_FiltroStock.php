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

// Verifica si se ha enviado el formulario de filtrado por stock
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera el valor de stock del formulario
    $stock = $_POST["stock"];

    try {
        // Asegura que $proveedor sea un objeto Proveedor
        if (!($proveedor instanceof Proveedor)) {
            throw new Exception("Error: El proveedor no es un objeto válido.");
        }

        // Lista de productos filtrados por stock
        $productos = ProductoDB::getByStock($stock, $proveedor);

        echo "<h2>Productos con stock igual a $stock</h2>";

        if (empty($productos)) {
            echo "<p>No se encontraron productos con el stock especificado.</p>";
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
    header("Location: ../Vista/form_ByStock.php");
    exit();
}
?>