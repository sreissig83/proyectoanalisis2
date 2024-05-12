<?php
    session_start();
    include_once '../db/conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //recepcion de datos por post a traves de ajax
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $titulo = (isset($_POST['titulo'])) ? $_POST['titulo'] : '';
    $autor = (isset($_POST['autor'])) ? $_POST['autor'] : '';
    $editorial = (isset($_POST['editorial'])) ? $_POST['editorial'] : '';
    $isbn = (isset($_POST['isbn'])) ? $_POST['isbn'] : '';
    $codbarra = (isset($_POST['codbarra'])) ? $_POST['codbarra'] : '';
    $costo = (isset($_POST['costo'])) ? $_POST['costo'] : '';
    $precioventa = (isset($_POST['precioventa'])) ? $_POST['precioventa'] : '';
    $puntopedidogral = (isset($_POST['puntopedidogral'])) ? $_POST['puntopedidogral'] : '';
    $puntopedidoventa = (isset($_POST['puntopedidoventa'])) ? $_POST['puntopedidoventa'] : '';
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

    switch($opcion){
        case 1:             //alta
            
            $consulta = "INSERT INTO articulo (Titulo,Autor,Id_editorial,ISBN,cod_barra,costo,precio_venta,punto_pedido_gral,punto_pedido_venta) VALUES ('$titulo','$autor','$editorial','$isbn','$codbarra','$costo','$precioventa','$puntopedidogral','$puntopedidoventa')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT id_articulo,Titulo,Autor,Id_editorial,ISBN,cod_barra,costo,precio_venta,punto_pedido_gral,punto_pedido_venta FROM articulo ORDER BY id_articulo DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 2:                             //editar
            $consulta = "UPDATE articulo SET Titulo='$titulo', Autor='$autor', Id_editorial='$editorial', ISBN='$isbn', cod_barra='$codbarra', costo='$costo', precio_venta='$precioventa', punto_pedido_gral='$puntopedidogral', punto_pedido_venta='$puntopedidoventa'  WHERE id_articulo='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT id_articulo,Titulo,Autor,Id_editorial,ISBN,cod_barra,costo,precio_venta,punto_pedido_gral,punto_pedido_venta FROM articulo WHERE Id_editorial='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 3://eliminar
            $consulta = "DELETE FROM articulo WHERE id_articulo='$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            break;
    }
    
    
    print json_encode($data, JSON_UNESCAPED_UNICODE); //Enviamos los datos en formato Json a main.js
    $conexion=null;
?>