<?php
session_start();

if (isset($_GET['CerrarSesion'])) {
    session_destroy();
    header("Location: ../Vista/index.php");
    exit();
}

if (isset($_GET['MostrarProductos'])) {
    header("Location: ../Vista/form_MostrarProductos.php");
    exit();
}

if (isset($_GET['FiltrarPorStock'])) {
    header("Location: ../Vista/form_ByStock.php");
    exit();
}

if (isset($_GET['FiltrarPorDescripcion'])) {
    header("Location: ../Vista/form_ByDescription.php");
    exit();
}

if (isset($_GET['AnadirProducto'])) {
    header("Location: ../Vista/form_AnadirProducto.php");
    exit();
}

if (isset($_GET['ModificarProducto'])) {
    header("Location: ../Vista/form_ModificarProducto.php");
    exit();
}

if (isset($_GET['EliminarProducto'])) {
    header("Location: ../Vista/form_EliminarProducto.php");
    exit();
}

if (isset($_GET['ModificarProveedor'])) {
    header("Location: ../Vista/form_ModificarProveedor.php");
    exit();
}
?>