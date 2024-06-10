<?php
    session_start();
    include_once '../db/conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $razonsocial = (isset($_POST['razonsocial'])) ? $_POST['razonsocial'] : '';
    $cuentapago = (isset($_POST['cuentapago'])) ? $_POST['cuentapago'] : '';
    $contacto = (isset($_POST['contacto'])) ? $_POST['contacto'] : '';
    $cuit = (isset($_POST['cuit'])) ? $_POST['cuit'] : '';
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    switch($opcion){
        case 1:           
            $consultaadd = "INSERT INTO proveedores (razon_social, cuenta_de_pago, contacto, cuit) VALUES ('$razonsocial','$cuentapago','$contacto','$cuit')";
            $resultadoadd = $conexion->prepare($consultaadd);
            $resultadoadd->execute();

            $consultaread = "SELECT razon_social, cuenta_de_pago, contacto, cuit FROM proveedores ORDER BY id_proveedor DESC LIMIT 1";
            $resultadoread = $conexion->prepare($consultaread);
            $resultadoread->execute();
            $data=$resultadoread->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 2:                             
            $consultaupdate = "UPDATE proveedores SET razon_social='$razonsocial', cuenta_de_pago='$cuentapago', contacto='$contacto', cuit='$cuit'  WHERE id_proveedor='$id' ";
            $resultadoupdate = $conexion->prepare($consultaupdate);
            $resultadoupdate->execute();

            $consultaread = "SELECT id_proveedor,razon_social, cuenta_de_pago, contacto, cuit FROM proveedores WHERE id_proveedor='$id' ";
            $resultadoread = $conexion->prepare($consultaread);
            $resultadoread->execute();
            $data=$resultadoread->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 3:
            $consultadelete = "DELETE FROM proveedores WHERE id_proveedor='$id'";
            $resultadodelete = $conexion->prepare($consultadelete);
            $resultadodelete->execute();
            $data=$resultadoread->fetchAll(PDO::FETCH_ASSOC);
            break;
    }
    
    
    print json_encode($data, JSON_UNESCAPED_UNICODE); //Enviamos los datos en formato Json a main.js
    $conexion=null;
?>