<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "meson_db";
    $conexion = new mysqli($servername, $username, $password, $dbname);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $consulta = "SELECT id_articulo, Titulo FROM articulo";
    $resultado = $conexion->query($consulta);

    $opciones = "";
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $opciones .= "<option value='" . $fila["id_articulo"] . "'>" . $fila["Titulo"] . "</option>";
        }
    }
    $conexion->close();
    print $opciones;
?>