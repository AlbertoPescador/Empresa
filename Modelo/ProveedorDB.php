<?php
include_once "Proveedor.php";

class ProveedorDB {
    public static function add(Proveedor $proveedor): bool {
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Verificar si el proveedor ya existe antes de insertar
        if (self::getProveedor($proveedor->getCodigo())) {
            // Proveedor ya existe
            return false;
        }

        // Verificar que no haya campos en blanco
        if (empty($proveedor->getCodigo()) || empty($proveedor->getPassword())) {
            return false;
        }

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
}

    private static function getProveedor(string $codigo): Proveedor {
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Preparamos la consulta SQL
        $sql = "SELECT * FROM proveedor WHERE codigo = :codigo";

        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":codigo", $codigo);
        $sentencia->setFetchMode(PDO::FETCH_CLASS, "Proveedor");
        
        $sentencia->execute();

        return $sentencia->fetch();
    }

    private static function getCompleto(string $codigo){
        $proveedor = 
    }

    private static function update (Proveedor $proveedor) {
        return $false;


    }
}
?>