<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "meson_db";
    $conexion = new mysqli($servername, $username, $password, $dbname);
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }
    $origen = (isset($_POST['origen'])) ? $_POST['origen'] : '';
    $consulta1 = "SELECT id, nombre FROM locaciones WHERE nombre != '$origen'";
    $consulta2 = "SELECT id_punto_venta, nombre FROM puntos_venta WHERE nombre != '$origen'";
    $resulcon1 = $conexion->query($consulta1);
    $resulcon2 = $conexion->query($consulta2);

    $opcionesd = "";
    if (($resulcon1->num_rows > 0)&&($resulcon2->num_rows > 0)) {
        while($fila = $resulcon1->fetch_assoc()) {
            $opcionesd .= "<option value='" . $fila["nombre"] . "'>" . $fila["nombre"] . "</option>";
        }
        while($fila = $resulcon2->fetch_assoc()) {
            $opcionesd .= "<option value='" . $fila["nombre"] . "'>" . $fila["nombre"] . "</option>";
        }
    }
    $conexion->close();
    echo $opcionesd;
?>