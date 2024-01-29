<?php
session_start();
include_once "../Modelo/ProveedorDB.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recoger los datos del formulario
    $codigoProv = $_POST["codigo"]; 
    $contrasena = $_POST["password"];

    // Realizar la autenticación
    $autenticado = ProveedorDB::getProveedor($codigoProv);
    $comprobacion = $autenticado->getPassword();

    if ($autenticado && password_verify($contrasena, $comprobacion)) {
        $_SESSION['codigo'] = $autenticado->getCodigo();
        // Inicio de sesión exitoso, redirigir a la página de inicio
        echo '<script>alert("Sesión iniciada correctamente. ¡Bienvenido!");</script>';
        echo '<script>window.location.href="../Vista/form_MostrarProductos.php";</script>';
        exit();
    } else {
        // Error en la autenticación, mostrar mensaje o redirigir a página de error
        echo '<script>alert("Error en el inicio de sesión. Verifica tus credenciales.");</script>';
        echo '<script>window.location.href="../Vista/form_Login.php";</script>';
        exit();
    }
}
?>