<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "meson_db";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    $sql = "SELECT id_articulo, Titulo FROM articulo";
    $result = $conn->query($sql);
    $options = "";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $options .= "<option value='" . $row["id_articulo"] . "'>" . $row["Titulo"] . "</option>";
        }
    }
    $conn->close();
    echo $options;
?>