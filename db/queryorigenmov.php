<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "meson_db";
    $conexion = new mysqli($servername, $username, $password, $dbname);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $consulta1 = "SELECT id, nombre FROM locaciones";
    $consulta2 = "SELECT id_punto_venta, nombre FROM puntos_venta";
    $resulcon1 = $conexion->query($consulta1);
    $resulcon2 = $conexion->query($consulta2);

    $opcioneso = "";
    if (($resulcon1->num_rows > 0)&&($resulcon2->num_rows > 0)) {
        while($fila = $resulcon1->fetch_assoc()) {
            $opcioneso .= "<option value='" . $fila["nombre"] . "'>" . $fila["nombre"] . "</option>";
        }
        while($fila = $resulcon2->fetch_assoc()) {
            $opcioneso .= "<option value='" . $fila["nombre"] . "'>" . $fila["nombre"] . "</option>";
        }
    }
    $conexion->close();
    echo $opcioneso;
?>


