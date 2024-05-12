<?php
    session_start();
    include_once '../db/conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //recepcion de datos por post a traves de ajax
    $nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $filename = "opcion.txt";
    switch($opcion){
        case 1:             //alta
            $consulta = "INSERT INTO editorial (Nombre) VALUES ('$nombre')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT Id_editorial, Nombre FROM editorial ORDER BY Id_editorial DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
       
        case 2:                             //editar
            $consulta = "UPDATE editorial SET Nombre='$nombre' WHERE Id_editorial='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            
            $consulta = "SELECT Id_editorial, Nombre FROM editorial WHERE Id_editorial='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        
        case 3://eliminar
            $content = "se eligio la opcion 3";
            file_put_contents($filename, $content);
            $consulta = "DELETE FROM editorial WHERE Id_editorial='$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            break;
    }
    
    
    print json_encode($data, JSON_UNESCAPED_UNICODE); //Enviamos los datos en formato Json a main.js
    $conexion=null;
?>