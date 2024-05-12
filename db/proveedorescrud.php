<?php
    include_once '../db/conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    //recepcion de datos por post a traves de ajax
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $razonsocial = (isset($_POST['razonsocial'])) ? $_POST['razonsocial'] : '';
    $cuentapago = (isset($_POST['cuentapago'])) ? $_POST['cuentapago'] : '';
    $contacto = (isset($_POST['contacto'])) ? $_POST['contacto'] : '';
    $cuit = (isset($_POST['cuit'])) ? $_POST['cuit'] : '';
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $filename = "opcion.txt";
    $content = "funciona";
    
    switch($opcion){
        
        case 1:             //alta
            
            file_put_contents($filename, $content);
            $consulta = "INSERT INTO proveedores (razon_social, cuenta_de_pago, contacto, cuit) VALUES ('$razonsocial','$cuentapago','$contacto','$cuit')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT razon_social, cuenta_de_pago, contacto, cuit FROM proveedores ORDER BY id_proveedor DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 2:                             //editar
            file_put_contents($filename, $content);
            $consulta = "UPDATE proveedores SET razon_social='$razonsocial', cuenta_de_pago='$cuentapago', contacto='$contacto', cuit='$cuit'  WHERE id_proveedor='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT id_proveedor,razon_social, cuenta_de_pago, contacto, cuit FROM proveedores WHERE id_proveedor='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 3://eliminar
            file_put_contents($filename, $content);
            $consulta = "DELETE FROM proveedores WHERE id_proveedor='$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            break;
    }
    
    
    print json_encode($data, JSON_UNESCAPED_UNICODE); //Enviamos los datos en formato Json a main.js
    $conexion=null;
?>