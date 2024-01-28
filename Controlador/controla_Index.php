<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["opcion"])) {
        $opcion = $_POST["opcion"];

        switch ($opcion) {
            case "Iniciar Sesión":
                // Redirige al formulario de inicio de sesión
                header("Location: ../Vista/form_Login.php");
                exit();
                break;

            case "Registrar Proveedor":
                // Redirige al formulario de registro de proveedor
                header("Location: ../Vista/form_Registro.php");
                exit();
                break;

        }
    }
}
?>