<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Registra un proveedor</h1>
    <form method="post" action="../Controlador/controla_Registro.php">
        
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>
    
        <label for="telefono">Teléfono:</label>
        <input type="number" name="telefono" required>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required>

        <input type="submit" class="submit" value="Registrar">
    </form>
</body>
</html>
