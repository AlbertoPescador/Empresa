<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Inicio de Sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <form method="post" action="../Controlador/controla_Inicio.php">
        
        <label for="codigo">Código de Usuario:</label>
        <input type="text" name="codigo" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" required>

        <input type="submit" class="submit" value="Iniciar Sesión">
    </form>
</body>
</html>
