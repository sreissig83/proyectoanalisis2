<?php require_once "parte_superior.php"?>
<div class="container">      
    <?php

    if(($_SESSION["s_idRol"] === 2) && ($_SESSION["s_rol_descripcion"] === "deposito") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")){
        $consultamov = "SELECT id_movimiento, fecha_mov, usuario, Origen, Destino  FROM movimientos";
        $resultadomov = $conexion->prepare($consultamov);
        $resultadomov->execute();
        $datamov=$resultadomov->fetchAll(PDO::FETCH_ASSOC);

        $consultalineamov = "SELECT  id_articulo, cantidad FROM linea_mov";
        $resultadolineamov = $conexion->prepare($consultalineamov);
        $resultadolineamov->execute();
        $datalineamov=$resultadolineamov->fetchAll(PDO::FETCH_ASSOC);
    }

    ?>
    <?php
        if(($_SESSION["s_idRol"] === 2) && ($_SESSION["s_rol_descripcion"] === "deposito") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")){
    ?>
            <!--Boton del Modal-->
            <div class="container">
                <div class="row">
                    <div class="col-log-12">
                        <button id="btnnuevoMov" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
            </div>   
            
            <!--Tabla de Editorial-->
            <div class="container">
                <div class="row">
                    <div class="col-log-12">
                        <div class="table-responsive">
                            <table id="tablamovimientos" class="table table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th>Fecha</th>
                                        <th>Usuario</th>
                                        <th>Origen</th>
                                        <th>Destino</th>
                                        <th>Articulo</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <?php
                                        foreach($datamov as $datmov) {
                                    ?>    
                                        <td class="text-center"><?php echo $datmov['id_movimiento']?></td>
                                        <td class="text-center"><?php echo $datmov['fecha_mov']?></td>
                                        <td class="text-center"><?php echo $datmov['usuario']?></td>
                                        <td class="text-center"><?php echo $datmov['Origen']?></td>
                                        <td class="text-center"><?php echo $datmov['Destino']?></td>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                    foreach($datalineamov as $datlineamov) {
                                    ?>    
                                        <td class="text-center"><?php echo $datlineamov['id_articulo']?></td>
                                        <td class="text-center"><?php echo $datlineamov['cantidad']?></td>
                                    <?php
                                        }
                                    ?>        
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Model del Crud de Editorial-->
            <div class="modal fade" id="modalCRUDmov" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formMovimientos">
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="row justify-content-center align-items-center g-2">   
                                    <div class="col">
                                        <label for="nombrecliente" class="col-form-label">Fecha:</label>
                                        <input type="date" class="form-control" id="fecha">
                                    </div>
                                    <div class="col">
                                        <label for="cuitcliente" class="col-form-label">Usuario:</label>
                                        <input type="text" class="form-control" id="usuario" value="<?php echo $_SESSION["s_usuario"];?>" readonly>
                                    </div>
                                </div>
                                <div class="row justify-content-center align-items-center g-2">   
                                    <div class="col">
                                            <label for="completemobile">Articulo</label>
                                            <?php
                                            $conn = new mysqli("localhost", "root", "", "meson_db");
                                            if ($conn->connect_error) {
                                                die("Conexión fallida: " . $conn->connect_error);
                                            }
                                            $sql = "SELECT id_articulo, Titulo FROM articulo";
                                            $resultado = $conn->query($sql);
                                            echo "<select name='editoriallibro' class='form-select' id='articulo1'>";
                                            echo "<option value=''></option>";
                                            if ($resultado->num_rows > 0) {
                                                while($fila = $resultado->fetch_assoc()) {
                                                    echo "<option value='" . $fila["id_articulo"] . "'>" . $fila["Titulo"] . "</option>";
                                                }
                                            }
                                            echo "</select>";
                                            $conn->close();
                                            ?>
                                        </div>
                                    <div class="col">
                                        <label for="apellidocliente" class="col-form-label">Cantidad:</label>
                                        <input type="text" class="form-control" id="cantidad1">
                                    </div>
                                </div>
                    <div class="row justify-content-center align-items-center g-2">   
                        <div class="form-group">
                        <label for="completemobile">Origen:</label>
                        <?php
                            
                            $conn = new mysqli("localhost", "root", "", "meson_db");
                            if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                            }
                            $consulta1 = "SELECT id, nombre FROM locaciones";
                            $consulta2 = "SELECT id_punto_venta, nombre FROM puntos_venta";
                            $resulcon1 = $conn->query($consulta1);
                            $resulcon2 = $conn->query($consulta2);
                            echo "<select name='movorigen' class='form-select' id='movorigen'>";
                            echo "<option value=''></option>";
                            if ($resulcon1->num_rows > 0) {
                                while($fila = $resulcon1->fetch_assoc()) {
                                echo "<option value='" . $fila["id"] . "'>" . $fila["nombre"] . "</option>";
                                }
                                while($fila = $resulcon2->fetch_assoc()) {
                                    echo "<option value='" . $fila["id_punto_venta"] . "'>" . $fila["nombre"] . "</option>";
                                    }
                            }
                            echo "</select>";
                            $conn->close();
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="completemobile">Destino:</label>
                        <?php
                            
                            $conn = new mysqli("localhost", "root", "", "meson_db");
                            if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                            }
                            $consulta1 = "SELECT id, nombre FROM locaciones";
                            $consulta2 = "SELECT id_punto_venta, nombre FROM puntos_venta";
                            $resulcon1 = $conn->query($consulta1);
                            $resulcon2 = $conn->query($consulta2);
                            echo "<select name='movorigen' class='form-select' id='movorigen'>";
                            echo "<option value=''></option>";
                            if ($resulcon1->num_rows > 0) {
                                while($fila = $resulcon1->fetch_assoc()) {
                                echo "<option value='" . $fila["id"] . "'>" . $fila["nombre"] . "</option>";
                                }
                                while($fila = $resulcon2->fetch_assoc()) {
                                    echo "<option value='" . $fila["id_punto_venta"] . "'>" . $fila["nombre"] . "</option>";
                                    }
                            }
                            echo "</select>";
                            $conn->close();
                        ?>
                    </div>    
                                
                                </div>
                            </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Aceptar</button>
                        </div>
                    </form>    
                </div>
                </div>
            </div>
        </div>
    <?php
        }else {
    ?>
    <h1>Acceso Denegado, Ud no posee permisos susficientes.</h1>
    <?php
        }
    ?>

<?php require_once "parte_inferior.php"?>