<?php

    $logout = (isset($_POST['logout'])) ? $_POST['logout'] : '';
    if($logout == 1){
        session_start();
        UNSET ($_SESSION["s_usuario"]);
        UNSET ($_SESSION["s_idRol"]);
        UNSET ($_SESSION["s_rol_descripcion"]);
        session_destroy();
        $data = 1;
    }
    print json_encode($data);
?>