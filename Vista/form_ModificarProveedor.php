<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa: Modificar Proveedor</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="stylesmenu.css">
</head>
<body>
    <header>
        <h1>Menú CRUD: Gestión Empresa</h1>
        <?php
        session_start();

        if (!isset($_SESSION['codigo'])) {
            header("Location: ../Vista/form_Login.php");
            exit();
        }

        $codigo_proveedor = $_SESSION['codigo'];
        ?>
        <p>Sesión iniciada como: <?php echo $codigo_proveedor; ?></p>
    </header>

    <nav>
        <a href="../Controlador/controla_Principal.php?MostrarProductos" id="MostrarProductos">Mostrar Productos</a>
        <a href="../Controlador/controla_Principal.php?FiltrarPorStock" id="FiltrarPorStock">Filtrar por Stock</a>
        <a href="../Controlador/controla_Principal.php?FiltrarPorDescripcion" id="FiltrarPorDescripcion">Filtrar por Descripción</a>
        <a href="../Controlador/controla_Principal.php?AnadirProducto" id="AnadirProducto">Añadir Producto</a>
        <a href="../Controlador/controla_Principal.php?ModificarProducto" id="ModificarProducto">Modificar Producto</a>
        <a href="../Controlador/controla_Principal.php?EliminarProducto" id="EliminarProducto">Eliminar Producto</a>
        <a href="../Controlador/controla_Principal.php?ModificarProveedor" id="ModificarProveedor">Modificar Proveedor</a>
        <a href="../Controlador/controla_Principal.php?CerrarSesion" id="CerrarSesion">Cerrar Sesión</a>
    </nav>

    <h2>Modificar Proveedor</h2>

    <form action="../Controlador/controla_ModificarProveedor.php" method="post">
        <label form="codigo">Código:</label>
        <input type="text" id="codigo" name="codigo" disabled><br>
        
        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
    
        <label for="telefono">Teléfono:</label>
        <input type="number" name="telefono" required>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required>   

        <input type="submit" value="Guardar Cambios">
    </form>
</body>
</html>