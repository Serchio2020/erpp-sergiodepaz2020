<?php

    require '../modelo/producto.modelo.php';

    if($_POST){
        $producto = new Producto();

        switch($_POST["accion"]){
            case "CONSULTAR":
                echo json_encode($producto->ConsultarTodo());
            break;
            case "CONSULTAR_ID":
                echo json_encode($producto->ConsultarPorId($_POST["idProducto"]));
            break;
            case "GUARDAR":
                $descripcion = $_POST["descripcion"];
                $id_proveedor = $_POST["id_proveedor"];
                $id_categoria = $_POST["id_categoria"];
                $precio = $_POST["precio"];
                $stock = $_POST["stock"];
                $fecha_ingreso = $_POST["fecha_ingreso"];

                if($descripcion == ""){
                    echo json_encode("Debe ingresar la descripción del producto");
                    return;
                }

                if($id_proveedor == ""){
                    echo json_encode("Debe ingresar el id del proveedor");
                    return;
                }

                if($id_categoria == ""){
                    echo json_encode("Debe ingresar el id de la categoría del producto");
                    return;
                }

                if($precio == ""){
                    echo json_encode("Debe ingresar el precio");
                    return;
                }

                if($stock == ""){
                    echo json_encode("Debe ingresar la cantidad que habrá en stock");
                    return;
                }
                if($fecha_ingreso == ""){
                    echo json_encode("Debe ingresar la fecha de ingreso");
                    return;
                }

                $respuesta = $producto->Guardar($descripcion, $id_proveedor, $id_categoria, $precio, $stock, $fecha_ingreso);
                echo json_encode($respuesta);
            break;
            case "MODIFICAR":
                $descripcion = $_POST["descripcion"];
                $id_proveedor = $_POST["id_proveedor"];
                $id_categoria = $_POST["id_categoria"];
                $precio = $_POST["precio"];
                $stock = $_POST["stock"];
                $fecha_ingreso = $_POST["fecha_ingreso"];
                $idProducto = $_POST["idProducto"];

                if($descripcion == ""){
                    echo json_encode("Debe ingresar la descripción del producto");
                    return;
                }

                if($id_proveedor == ""){
                    echo json_encode("Debe ingresar el id del proveedor");
                    return;
                }

                if($id_categoria == ""){
                    echo json_encode("Debe ingresar el id de la categoría del producto");
                    return;
                }

                if($precio == ""){
                    echo json_encode("Debe ingresar el precio");
                    return;
                }

                if($stock == ""){
                    echo json_encode("Debe ingresar la cantidad que habrá en stock");
                    return;
                }
                if($fecha_ingreso == ""){
                    echo json_encode("Debe ingresar la fecha de ingreso");
                    return;
                }

                $respuesta = $producto->Modificar ($descripcion, $id_proveedor, $id_categoria, $precio, $stock, $fecha_ingreso, $idProducto);
                
                echo json_encode($respuesta);
            break;
            case "ELIMINAR":
                $idProducto = $_POST["idProducto"];
                $respuesta = $producto->Eliminar($idProducto);
                echo json_encode($respuesta);
            break;
        }
    }

?>