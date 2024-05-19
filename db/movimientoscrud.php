<?php
    session_start(); 
    include_once 'conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();
    
    

    

    $fecha = (isset($_POST['fechamov'])) ? $_POST['fechamov'] : '';
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : ''; 
    $origen = (isset($_POST['origen'])) ? $_POST['origen'] : ''; 
    $destino = (isset($_POST['destino'])) ? $_POST['destino'] : '';
    $contadorprod = (isset($_POST['contadorArticulos'])) ? $_POST['contadorArticulos'] : '';

    $timestamp = strtotime($fecha);
    $datetime_sql = date('Y-m-d H:i:s', $timestamp);
    $conexion = mysqli_connect("localhost", "root", "", "meson_db");
    $consulta = "SELECT usuario_id FROM usuarios WHERE usuario_uname = '$usuario'";
    $resultado = mysqli_query($conexion, $consulta);
    if ($resultado) {
        $fila = mysqli_fetch_assoc($resultado);
        $idusuario = $fila['usuario_id'];
        mysqli_free_result($resultado);
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
    };
    $consultamovimiento = "INSERT INTO movimientos (fecha_mov, usuario, origen, destino) VALUES ('$datetime_sql','$idusuario','$origen','$destino')";
    $resultadomovimiento = $conexion->prepare($consultamovimiento);
    $resultadomovimiento->execute();

    $consultalineamov = "SELECT id_movimiento FROM movimientos WHERE fecha_mov = '$datetime_sql' AND usuario = '$idusuario'";
    $resultadolineamov = mysqli_query($conexion, $consultalineamov);
    if ($resultadolineamov) {
        $fila = mysqli_fetch_assoc($resultadolineamov);
        $idlineamov = $fila['id_movimiento'];
        mysqli_free_result($resultadolineamov);
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
    };
        
    for($i = 1; $i <= $contadorprod; $i++){
        $articulo = (isset($_POST['articulo'.$i])) ? $_POST['articulo'.$i] : '';
        $cantidad = (isset($_POST['cantidad'.$i])) ? $_POST['cantidad'.$i] : ''; 
        $consultalineamovimiento = "INSERT INTO linea_mov (id_mov, id_art, cantidad) VALUES ('$idlineamov', '$articulo', '$cantidad')";
        $resultadolineamovimiento = $conexion->prepare($consultalineamovimiento);
        $resultadolineamovimiento->execute();
    
    
    };

    $consultatotal = "SELECT m.id_movimiento, m.fecha_mov, m.usuario, m.origen, m.destino, lm.id_art,lm.cantidad FROM movimientos m JOIN linea_mov lm WHERE m.id_movimiento = '$idlineamov'";
    $resultadototal = $conexion->prepare($consultatotal);
    $resultadototal->execute();
    $data=$resultadototal->fetch(PDO::FETCH_ASSOC);

    print json_encode($data, JSON_UNESCAPED_UNICODE); 
    $conexion=null;
?>