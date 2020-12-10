<?php

    require 'conexion.php';

    class Producto {

        public function ConsultarTodo(){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("SELECT * FROM productos");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function ConsultarPorId($idProducto){
            $conexion = new Conexion();
            $stmt = $conexion->prepare("SELECT * FROM productos where idProducto = :idProducto");
            $stmt->bindValue(":idProducto", $idProducto, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function Guardar($descripcion, $id_proveedor, $id_categoria, $precio, $stock, $fecha_ingreso){

            $conexion = new Conexion();
            $stmt = $conexion->prepare("INSERT INTO `productos`
                                                (`descripcion`,
                                                `idProveedor`,
                                                `idCategoria`,
                                                `precio`,
                                                `stock`,
                                                `fecha_ingreso`)
                                    VALUES (:descripcion,
                                            :id_proveedor,
                                            :id_categoria,
                                            :precio,
                                            :stock,
                                            :fecha_ingreso);");
            $stmt->bindValue(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindValue(":id_proveedor", $id_proveedor, PDO::PARAM_INT);
            $stmt->bindValue(":id_categoria", $id_categoria, PDO::PARAM_INT);
            $stmt->bindValue(":precio", $precio, PDO::PARAM_INT);
            $stmt->bindValue(":stock", $stock, PDO::PARAM_STR);
            $stmt->bindValue(":fecha_ingreso", $fecha_ingreso, PDO::PARAM_STR);

            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al guardar la información";
            }

        }

        public function Modificar($descripcion, $id_proveedor, $id_categoria, $precio, $stock, $fecha_ingreso, $idProducto){

            $conexion = new Conexion();
            $stmt = $conexion->prepare("UPDATE `productos`
                                        SET `descripcion` = :descripcion,
                                        `idProducto` = :idProducto,
                                        `idCategoria` = :idCategoria,
                                        `precio` = :precio,
                                        `stock` = :stock,
                                        `fecha_ingreso` = :fecha_ingreso
                                        WHERE `idProducto` = :idProducto;");
            $stmt->bindValue(":descripcion", $descripcion, PDO::PARAM_STR);
            $stmt->bindValue(":idProveedor", $id_proveedor, PDO::PARAM_INT);
            $stmt->bindValue(":idCategoria", $id_categoria, PDO::PARAM_INT);
            $stmt->bindValue(":precio", $precio, PDO::PARAM_STR);
            $stmt->bindValue(":stock", $stock, PDO::PARAM_STR);
            $stmt->bindValue(":fecha_ingreso", $fecha_ingreso, PDO::PARAM_STR);
            $stmt->bindValue(":idProducto", $idProducto, PDO::PARAM_INT);

            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al modificar la información";
            }

        }

        public function Eliminar($idProducto){

            $conexion = new Conexion();
            $stmt = $conexion->prepare("DELETE FROM productos WHERE idProducto = :idProducto");
            $stmt->bindValue(":idProducto", $idProducto, PDO::PARAM_INT);

            if($stmt->execute()){
                return "OK";
            }else{
                return "Error: se ha generado un error al eliminar la información";
            }

        }

    }

?>