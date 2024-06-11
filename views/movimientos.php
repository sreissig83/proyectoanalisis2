<?php require_once "parte_superior.php"?>      
<?php

    if(($_SESSION["s_idRol"] === 2) && ($_SESSION["s_rol_descripcion"] === "deposito") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")||($_SESSION["s_idRol"] === 3) && ($_SESSION["s_rol_descripcion"] === "venta")||($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){
        $consultamov = " SELECT m.id_movimiento, m.fecha_mov, u.usuario_uname, m.Origen, m.Destino, a.Titulo, lm.cantidad FROM movimientos m JOIN linea_mov lm ON m.id_movimiento = lm.id_mov JOIN usuarios u ON m.usuario = u.usuario_id JOIN articulo a ON lm.id_art = a.id_articulo";
        $resultadomov = $conexion->prepare($consultamov);
        $resultadomov->execute();
        $datamov=$resultadomov->fetchAll(PDO::FETCH_ASSOC);

    };

    ?>
    <?php
        if(($_SESSION["s_idRol"] === 2) && ($_SESSION["s_rol_descripcion"] === "deposito") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")){
    ?>
            
            <div class="container-fluid"><h2 class="text-center">Movimientos</h2></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-1 col-sm-6 text-left">
                        <button id="btnnuevoMov" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                    </div>
                    <div class="col-lg-11 col-sm-6 text-right">
                        <a id="helpmovimientos" class="btn btn-info" href="./helpmovimientos.html" target="_blank">Ayuda</a>
                    </div>
                </div>
            </div>   
            
            
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
                                <?php foreach ($datamov as $row): ?>
                                        <tr>
                                            <td><?php echo $row['id_movimiento']; ?></td>
                                            <td><?php echo $row['fecha_mov']; ?></td>
                                            <td><?php echo $row['usuario_uname']; ?></td>
                                            <td><?php echo $row['Origen']; ?></td>
                                            <td><?php echo $row['Destino']; ?></td>
                                            <td><?php echo $row['Titulo']; ?></td>
                                            <td><?php echo $row['cantidad']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            
            
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
                                        <input type="datetime-local" class="form-control" id="fecha">
                                    </div>
                                    <div class="col">
                                        <label for="cuitcliente" class="col-form-label">Usuario:</label>
                                        <input type="text" class="form-control" id="usuario" value="<?php echo $_SESSION["s_usuario"];?>" readonly>
                                    </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2">   
                            <div class="col">   
                                <div class="form-group">
                                    <label for="origenmovimiento">Origen</label>
                                    <select id="origenmov" name="origenmov" class="form-select"></select>
                                </div>
                            </div>     
                            <div class="col">   
                                <div class="form-group">
                                    <label for="destinomovimiento">Destino</label>
                                    <select id="destinomov" name="destinomov" class="form-select" disabled></select>
                                </div>    
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">   
                            <div class="col">
                                <button type="button" class="btn btn-success" onclick="agregarCampoSelect()">Agregar Producto</button>
                            </div>
                        </div>
                        <br>        
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col align-items-center"></div>
                        </div>
                        <div id="contenedorSelects">
                        </div>
                        
                        
                        <div class="modal-footer">
                            <button type="button" id="btnCancelar" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnGuardar" class="btn btn-dark">Aceptar</button>
                        </div>
                    </form>    
                </div>
                </div>
            </div>
        </div>
    <?php
        }else if(($_SESSION["s_idRol"] === 3) && ($_SESSION["s_rol_descripcion"] === "venta")){
    ?>
    
       
            
            
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
                                <?php foreach ($datamov as $row): ?>
                                        <tr>
                                            <td><?php echo $row['id_movimiento']; ?></td>
                                            <td><?php echo $row['fecha_mov']; ?></td>
                                            <td><?php echo $row['usuario_uname']; ?></td>
                                            <td><?php echo $row['Origen']; ?></td>
                                            <td><?php echo $row['Destino']; ?></td>
                                            <td><?php echo $row['Titulo']; ?></td>
                                            <td><?php echo $row['cantidad']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            
            
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
                                        <input type="datetime-local" class="form-control" id="fecha">
                                    </div>
                                    <div class="col">
                                        <label for="cuitcliente" class="col-form-label">Usuario:</label>
                                        <input type="text" class="form-control" id="usuario" value="<?php echo $_SESSION["s_usuario"];?>" readonly>
                                    </div>
                            </div>
                            <div class="row justify-content-center align-items-center g-2">   
                            <div class="col">   
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
                                        echo "<select name='origen' class='form-select' id='movorigen'>";
                                        echo "<option value=''></option>";
                                        if ($resulcon1->num_rows > 0) {
                                            while($fila = $resulcon1->fetch_assoc()) {
                                            echo "<option value='" . $fila["nombre"] . "'>" . $fila["nombre"] . "</option>";
                                            }
                                            while($fila = $resulcon2->fetch_assoc()) {
                                            echo "<option value='" . $fila["nombre"] . "'>" . $fila["nombre"] . "</option>";
                                            }
                                        }
                                        echo "</select>";
                                        $conn->close();
                                    ?>
                                </div>
                            </div>     
                            <div class="col">   
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
                                        echo "<select name='destino' class='form-select' id='movdestino'>";
                                        echo "<option value=''></option>";
                                        if ($resulcon1->num_rows > 0) {
                                            while($fila = $resulcon1->fetch_assoc()) {
                                            echo "<option value='" . $fila["nombre"] . "'>" . $fila["nombre"] . "</option>";
                                            }
                                            while($fila = $resulcon2->fetch_assoc()) {
                                                echo "<option value='" . $fila["nombre"] . "'>" . $fila["nombre"] . "</option>";
                                                }
                                        }
                                        echo "</select>";
                                        $conn->close();
                                    ?>
                                </div>    
                            </div>
                        </div>
                        <div class="row justify-content-center align-items-center g-2">   
                            <div class="col">
                                <button type="button" class="btn btn-success" onclick="agregarCampoSelect()">Agregar Producto</button>
                            </div>
                        </div>
                        <br>        
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col align-items-center"></div>
                        </div>
                        <div id="contenedorSelects">
                        </div>
                        
                        
                        <div class="modal-footer">
                            <button type="button" id="btnCancelar" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" id="btnGuardar" class="btn btn-dark">Aceptar</button>
                        </div>
                    </form>    
                </div>
                </div>
            </div>
        </div>
        <?php
    }else if(($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){
    ?>
    <div class="container-fluid"><h2 class="text-center">Movimientos</h2></div>
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
                                <?php foreach ($datamov as $row): ?>
                                        <tr>
                                            <td><?php echo $row['id_movimiento']; ?></td>
                                            <td><?php echo $row['fecha_mov']; ?></td>
                                            <td><?php echo $row['usuario_uname']; ?></td>
                                            <td><?php echo $row['Origen']; ?></td>
                                            <td><?php echo $row['Destino']; ?></td>
                                            <td><?php echo $row['Titulo']; ?></td>
                                            <td><?php echo $row['cantidad']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
    <?php
    }else{
    ?>
    <h1>Acceso Denegado, Ud no posee permisos susficientes.</h1>
    <?php
        }
    ?>
<?php require_once "parte_inferior.php"?>