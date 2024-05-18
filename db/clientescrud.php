<?php
    session_start();
    include_once '../db/conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //recepcion de datos por post a traves de ajax
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $apellido = (isset($_POST['apellido'])) ? $_POST['apellido'] : '';
    $cuit = (isset($_POST['cuit'])) ? $_POST['cuit'] : '';
    $domicilio = (isset($_POST['domicilio'])) ? $_POST['domicilio'] : '';
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $filename = "opcion.txt";
    $content = $cuit;

    switch($opcion){
        
        case 1:             //alta
            $consulta = "INSERT INTO cliente (Nombre, Apellido, CUIT, Domicilio) VALUES ('$nombre','$apellido','$cuit','$domicilio')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT id_cliente,Nombre, Apellido, CUIT, Domicilio FROM cliente ORDER BY id_cliente DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 2:                             //editar
            $consulta = "UPDATE cliente SET Nombre='$nombre', Apellido='$apellido', CUIT='$cuit', Domicilio='$domicilio'  WHERE id_cliente='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT id_cliente,Nombre, Apellido, CUIT, Domicilio FROM cliente WHERE id_cliente='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 3://eliminar
            $consulta = "DELETE FROM cliente WHERE id_cliente='$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            break;
    }
    
    
    print json_encode($data, JSON_UNESCAPED_UNICODE); //Enviamos los datos en formato Json a main.js
    $conexion=null;
?>