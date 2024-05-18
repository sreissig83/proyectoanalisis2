<?php
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "meson_db";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    $consulta = "SELECT Id_editorial, Nombre FROM editorial";
    $resultado = $conn->query($consulta);
    $opciones = "";
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $opciones .= "<option value='" . $fila["Id_editorial"] . "'>" . $fila["Nombre"] . "</option>";
        }
    }
    $conn->close();
    echo $opciones;
?>