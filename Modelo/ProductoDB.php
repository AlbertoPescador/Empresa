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
        $sql = "INSERT INTO producto (codigo, descripcion, precio, stock, codigo_proveedor) 
                VALUES (:codigo, :descripcion, :precio, :stock, :codigo_proveedor)";

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(":codigo", $producto->getCodigo());
        $sentencia->bindValue(":descripcion", $producto->getDescripcion());
        $sentencia->bindValue(":precio", $producto->getPrecio());
        $sentencia->bindValue(":stock", $producto->getStock());
        $sentencia->bindValue(":codigo_proveedor", $proveedor->getCodigo());

        $result = $sentencia->execute();

        return $result;
    }

    // Obtener todos los productos
    public static function getAll(Proveedor $proveedor): Array{
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Creamos un array para almacenar los productos
        $listaProductos = [];

        // Preparamos la consulta SQL
        $sql = "SELECT * FROM producto where codigo_proveedor = :codigo_proveedor";
        $sentencia = $conexion->prepare($sql);

        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->bindValue(":codigo_proveedor", $proveedor->getCodigo());
        $sentencia->execute();

        while ($productos = $sentencia->fetch()){
            $producto = new Producto($productos['codigo'], $productos['descripcion'], $productos['precio'], $productos['stock']);;
            $listaProductos[] = $producto;
        }

        return $listaProductos;
    }

    // Filtrar productos por descripción y proveedor
    public static function getByDescripcionAndProveedor(Proveedor $proveedor, $descripcion): Array {
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Creamos un array para almacenar los productos
        $listaProductos = [];

        // Preparamos la consulta SQL
        $sql = "SELECT * FROM producto
                WHERE descripcion = :descripcion AND codigo_proveedor = :codigo_proveedor";
        $sentencia = $conexion->prepare($sql);

        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->bindValue(":descripcion", $descripcion);
        $sentencia->bindValue(":codigo_proveedor", $proveedor->getCodigo());
        $sentencia->execute();

        while ($productos = $sentencia->fetch()){
            $producto = new Producto($productos['codigo'], $productos['descripcion'], $productos['precio'], $productos['stock']);;
            $listaProductos[] = $producto;
        }

        return $listaProductos;
    }

    // Filtrar productos por stock
    public static function getByStock(Proveedor $proveedor, int $stock): array {
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();
    
        // Creamos un array para almacenar los productos
        $listaProductos = [];
    
        // Preparamos la consulta SQL
        $sql = "SELECT * FROM producto
                WHERE stock <= :stock AND codigo_proveedor = :codigo_proveedor";
        $sentencia = $conexion->prepare($sql);
    
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->bindValue(":stock", $stock);
        $sentencia->bindValue(":codigo_proveedor", $proveedor->getCodigo());
        $sentencia->execute();
    
        while ($productos = $sentencia->fetch()) {
            // Crear un objeto Producto y establecer sus propiedades
            $producto = new Producto($productos['codigo'], $productos['descripcion'], $productos['precio'], $productos['stock']);
    
            // Agregar el objeto Producto al array
            $listaProductos[] = $producto;
        }
    
        return $listaProductos;
    }
        

    // Modificar producto
    public static function update(Producto $producto, Proveedor $proveedor): bool {
        // Lógica para modificar el producto en la base de datos
        $result = false;

        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Preparamos la consulta SQL
        $sql = "UPDATE producto
                SET descripcion = :descripcion, precio = :precio, stock = :stock
                WHERE codigo = :codigo AND codigo_proveedor = :codigo_proveedor";

        $sentencia = $conexion->prepare($sql);

        $sentencia->bindValue(":codigo", $producto->getCodigo());
        $sentencia->bindValue(":descripcion", $producto->getDescripcion());
        $sentencia->bindValue(":precio", $producto->getPrecio());
        $sentencia->bindValue(":stock", $producto->getStock());
        $sentencia->bindValue(":codigo_proveedor", $proveedor->getCodigo());

        // Ejecutamos la actualización
        $result = $sentencia->execute();

        return $result;
    }

    // Eliminar producto por código
    public static function deleteByCodigo(Producto $producto): bool {
        // Lógica para eliminar el producto de la base de datos
        $result = false;

        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();

        // Preparamos la consulta SQL
        $sql = "DELETE FROM producto WHERE codigo = :codigo AND codigo_proveedor = :codigo_proveedor";
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindValue(":codigo", $producto->getCodigo());
        $sentencia->bindValue(":codigo_proveedor", $producto->getMiProveedor()->getCodigo());
        // Ejecutamos la eliminación
        $result = $sentencia->execute();

        return $result;
    }

    // Obtener producto por código
    public static function getByCodigo(string $codigo): Producto {
        // Establecemos conexión con la BBDD
        include_once "../Conexion/conexion.php";
        $conexion = Conexion::obtenerConexion();
    
        // Preparamos la consulta SQL
        $sql = "SELECT * FROM producto WHERE codigo = :codigo";
    
        $sentencia = $conexion->prepare($sql);      
        $sentencia->execute(['codigo' => $codigo]);
    
        // Verificar si hay resultados antes de intentar crear una instancia de Proveedor
        $row = $sentencia->fetch();

        // Crear una instancia de Proveedor con los datos obtenidos de la base de datos
        $productos = new Producto($row['codigo'], $row['descripcion'], $row['precio'], $row['stock']);

        return $productos;
    }
}
?>