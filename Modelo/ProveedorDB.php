<?php
include_once "Proveedor.php";

class ProveedorDB {
    public static function add(Proveedor $proveedor): bool {
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Hashear la contraseña antes de almacenarla
        $hashedPassword = password_hash($proveedor->getPassword(), PASSWORD_DEFAULT);

        // Preparamos la consulta SQL
        $sql = "INSERT INTO proveedor (codigo, password, telefono, nombre, apellidos) 
                VALUES (:codigo, :password, :telefono, :nombre, :apellidos)";

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(":codigo", $proveedor->getCodigo());
        $sentencia->bindValue(":password", $hashedPassword);
        $sentencia->bindValue(":telefono", $proveedor->getTelefono());
        $sentencia->bindValue(":nombre", $proveedor->getNombre());
        $sentencia->bindValue(":apellidos", $proveedor->getApellidos());

        // Ejecutar la sentencia y verificar si fue exitosa
        $result = $sentencia->execute();

        return $result; // Devolver el resultado de la ejecución
    }

    public static function getProveedor(string $codigo): Proveedor {
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();
    
        // Preparamos la consulta SQL
        $sql = "SELECT * FROM proveedor WHERE codigo = :codigo";
    
        $sentencia = $conexion->prepare($sql);      
        $sentencia->execute(['codigo' => $codigo]);
    
        // Verificar si hay resultados antes de intentar crear una instancia de Proveedor
        $row = $sentencia->fetch();

        // Crear una instancia de Proveedor con los datos obtenidos de la base de datos
        $proveedores = new Proveedor($row['codigo'], $row['password'], $row['telefono'], $row['nombre'], $row['apellidos']);

        return $proveedores;
    }
    

    public static function getCompleto(string $codigo): Proveedor{
        $obtenerProductos = [];

        $obtenerProveedor = self::getProveedor($codigo);
        $obtenerProductos = ProductosDB::getProductos($obtenerProveedor);
        $obtenerProveedor->setMisProductos($obtenerProductos);

        return $obtenerProveedor;
    }

    public static function update(Proveedor $proveedor) {
        $result = false;

        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();
        
        // Preparamos la consulta SQL
        $sql = "UPDATE proveedor
                SET password = :password, telefono = :telefono, nombre = :nombre, apellidos = :apellidos
                WHERE codigo = :codigo";

        $hashedPassword = password_hash($proveedor->getPassword(), PASSWORD_DEFAULT);
        
        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(":codigo", $producto->getCodigo());
        $sentencia->bindValue(":password", $hashedPassword);
        $sentencia->bindValue(":telefono", $proveedor->getTelefono());
        $sentencia->bindValue(":nombre", $proveedor->getNombre());
        $sentencia->bindValue(":apellidos", $proveedor->getApellidos());

        // Ejecutamos la actualización
        $result = $sentencia->execute();

        return $result;
    }
}
?>