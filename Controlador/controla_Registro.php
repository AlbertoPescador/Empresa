<?php
include_once "../Modelo/ProveedorDB.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {


        // Recoger los datos del formulario
        $codigo = $_POST["codigo"];
        $password = $_POST["password"];
        $telefono = $_POST["telefono"];
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];

        // Crear una instancia de la clase Proveedor con los datos del formulario
        $nuevoProveedor = new Proveedor($codigo, $password, $telefono, $nombre, $apellidos);

        // Intentar registrar el nuevo proveedor
        if (ProveedorDB::add($nuevoProveedor)) {
            // Registro exitoso, redirigir a la página de inicio de sesión
            echo '<script>alert("Proveedor registrado correctamente. ¡Bienvenido! Ahora puedes iniciar sesión.");</script>';
            echo '<script>window.location.href="../Vista/index.php";</script>';
            exit();
        } else {
            // Error en el registro
            echo "Hubo un error al registrar el Proveedor.";
        }
    }

?>