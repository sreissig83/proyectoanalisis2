<?php
    session_start(); /*Se inicia una sesion entre el usuairo y el servidor, permitiendo acceder a los valores guardados dentro de las variables de sesion*/
    
    include_once 'conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    /*Recepcion de datos por metodo POST a traves de ajax*/
    $id = (isset($_POST['id'])) ? $_POST['id'] : '';
    $usuario = (isset($_POST['nombreusuario'])) ? $_POST['nombreusuario'] : ''; /*la funcion isset chequea que la variable este definida y que no sea null o vacia*/
    $passk = (isset($_POST['passkusuario'])) ? $_POST['passkusuario'] : ''; /*la funcion isset cheuqea que la variable este definida y que no sea null o vacia*/
    $nombres = (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
    $apellidos =  (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
    $dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
    $correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
    $rol = (isset($_POST['rol'])) ? $_POST['rol'] : '';
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    
    $passk = md5($passk);
    switch($opcion){
        case 1:            
            
            $consulta = "INSERT INTO usuarios (usuario_uname, usuario_passk, usuario_nombres, usuario_apellidos, usuario_dni, usuario_correo, roles) VALUES ('$usuario','$passk','$nombres','$apellidos','$dni','$correo','$rol')";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT usuario_uname, usuario_passk, usuario_nombres, usuario_apellidos, usuario_dni, usuario_correo, roles FROM usuarios ORDER BY usuario_id DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 2:                             
            $consulta = "UPDATE usuarios SET usuario_uname='$usuario', usuario_passk='$passk', usuario_nombres='$nombres', usuario_apellidos='$apellidos', usuario_dni='$dni', usuario_correo='$correo', roles='$rol'  WHERE usuario_id='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();

            $consulta = "SELECT usuario_id, usuario_uname, usuario_passk, usuario_nombres, usuario_apellidos, usuario_dni, usuario_correo, roles FROM usuarios WHERE usuario_id='$id' ";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 3:
            $consulta = "DELETE FROM usuarios WHERE usuario_id='$id'";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            break;
    }
    
    print json_encode($data);
    $conexion=null;
?>