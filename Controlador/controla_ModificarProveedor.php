<?php
// Inicia o reanuda la sesión
session_start();

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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $password = $_POST["password"];
    $telefono = $_POST["telefono"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];

    // Modifica los atributos del proveedor
    $proveedor->setPassword($password);
    $proveedor->setTelefono($telefono);
    $proveedor->setNombre($nombre);
    $proveedor->setApellidos($apellidos);

    // Intenta actualizar el proveedor utilizando la función update
    $proveedorActualizado = ProveedorDB::update($proveedor);

    if ($proveedorActualizado) {
        // Proveedor modificado
        echo '<script>alert("Proveedor modificado correctamente");</script>';
        echo '<script>window.location.href="../Vista/form_MostrarProveedores.php";</script>';
    } else {
        echo '<script>alert("Error al modificar el proveedor");</script>';
        echo '<script>window.location.href="../Vista/form_ModificarProveedor.php";</script>';
    }
}

// Obtiiene los datos del proveedor para prellenar el formulario
$datosProveedor = [
    'codigo' => $proveedor->getCodigo(),
    'telefono' => $proveedor->getTelefono(),
    'nombre' => $proveedor->getNombre(),
    'apellidos' => $proveedor->getApellidos()
];

?>