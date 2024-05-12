<?php
    session_start(); 
    include_once 'conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

   
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : ''; /*la funcion isset chequea que la variable este definida y que no sea null o vacia*/
    $passk = (isset($_POST['password'])) ? $_POST['password'] : ''; /*la funcion isset cheuqea que la variable este definida y que no sea null o vacia*/
    
    $passk = md5($passk);
    $consulta = "SELECT usuarios.roles AS idRol, roles.descripcion AS rol FROM usuarios JOIN roles ON usuarios.roles = roles.id WHERE usuario_uname='$usuario' AND usuario_passk='$passk' ";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();


    if($resultado->rowCount() >= 1){ 
            $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION["s_usuario"] = $usuario;
            $_SESSION["s_idRol"] =  $data[0]["idRol"];
            $_SESSION["s_rol_descripcion"] = $data[0]["rol"];
    }else{
            $data=null;
            $_SESSION["s_usuario"] = null;
            $_SESSION["s_idRol"] =  null;
            $_SESSION["s_rol_descripcion"] = null;
    };
    print json_encode($data);
    $conexion=null;
?>