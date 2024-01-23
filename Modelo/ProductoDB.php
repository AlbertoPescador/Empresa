<?php
include_once "Producto.php";

class ProductoDB {
    // Añadir producto en la BBDD
    public static function add(Producto $producto, Proveedor $proveedor): bool {
        $result = false;

        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Preparamos la consulta SQL
        $sql = "INSERT INTO producto (codigo, descripcion, precio, stock, proveedor_id) 
                VALUES (:codigo, :descripcion, :precio, :stock, :proveedor_id)";

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(":codigo", $producto->getCodigo());
        $sentencia->bindValue(":descripcion", $producto->getDescripcion());
        $sentencia->bindValue(":precio", $producto->getPrecio());
        $sentencia->bindValue(":stock", $producto->getStock());
        $sentencia->bindValue(":proveedor_id", $producto->getMiProveedor()->getCodigo());

        return $sentencia->execute();
    }

    // Obtener todos los productos
    public static function getAll(Proveedor $proveedor): Array{
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Preparamos la consulta SQL
        $sql = "SELECT * FROM producto where codigo = :codigo";
        $sentencia = $conexion->prepare($sql);

        $sentencia->setFetchMode(PDO::FETCH_CLASS, "Producto");
        $sentencia->execute();

        return $sentencia->fetchAll();
    }

    // Filtrar productos por descripción y proveedor
    public static function getByDescripcionAndProveedor(Proveedor $proveedor, $descripcion) {
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Preparamos la consulta SQL
        $sql = "SELECT * FROM producto
                WHERE descripcion = :descripcion AND proveedor_id = :proveedor_id";
        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(":descripcion", $descripcion);
        $sentencia->bindValue(":proveedor_id", $proveedor->getId());
        $sentencia->execute();

        // Devolvemos la lista de productos como un array asociativo
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);

        $productos = array();


    }



    // Modificar producto
    public static function update(Producto $producto, $nuevosDatos): bool {
        // Lógica para modificar el producto en la base de datos
        $result = false;

        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Preparamos la consulta SQL
        $sql = "UPDATE producto
                SET descripcion = :descripcion, precio = :precio, stock = :stock
                WHERE codigo = :codigo";

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(":descripcion", $nuevosDatos['descripcion']);
        $sentencia->bindValue(":precio", $nuevosDatos['precio']);
        $sentencia->bindValue(":stock", $nuevosDatos['stock']);
        $sentencia->bindValue(":codigo", $producto->getCodigo());

        // Ejecutamos la actualización
        $result = $sentencia->execute();

        return $result;
    }

    // Eliminar producto por código
    public static function deleteByCodigo($codigo): bool {
        // Lógica para eliminar el producto de la base de datos
        $result = false;

        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Preparamos la consulta SQL
        $sql = "DELETE FROM producto WHERE codigo = :codigo";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":codigo", $codigo);

        // Ejecutamos la eliminación
        $result = $sentencia->execute();

        return $result;
    }

    // Obtener producto por código
    public static function getByCodigo(string $codigo) {
        // Lógica para obtener producto por código de la base de datos
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Preparamos la consulta SQL
        $sql = "SELECT * FROM producto WHERE codigo = :codigo";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":codigo", $codigo);
        $sentencia->setFetchMode(PDO::FETCH_CLASS, "Producto");
        $sentencia->execute();

        return $sentencia->fetch();
    }
}
?>