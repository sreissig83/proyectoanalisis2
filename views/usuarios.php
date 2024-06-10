<?php require_once "parte_superior.php"?>
<div class="container">      
    <?php
    $consulta = "SELECT usuario_id, usuario_uname, usuario_passk, usuario_nombres, usuario_apellidos, usuario_dni, usuario_correo, roles FROM usuarios";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

    ?>
    <?php
        if(($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")){
    ?>
    
    <div class="container-fluid"><h2 class="text-center">Usuarios</h2></div>
    <div class="container">
        <div class="row">
            <div class="col-log-12">
                <button id="btnnuevoUser" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
    </div>   
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-log-12">
                <div class="table-responsive">
                    <table id="tablausuarios" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th class="text-center">Id</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>DNI</th>
                                <th>Correo</th>
                                <th>Roles</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($data as $dat) {
                            ?>    
                            <tr>
                                <td class="text-center"><?php echo $dat['usuario_id']?></td>
                                <td class="text-center"><?php echo $dat['usuario_uname']?></td>
                                <td class="text-center" ><?php echo $dat['usuario_passk']?></td>
                                <td class="text-center"><?php echo $dat['usuario_nombres']?></td>
                                <td class="text-center"><?php echo $dat['usuario_apellidos']?></td>
                                <td class="text-center"><?php echo $dat['usuario_dni']?></td>
                                <td class="text-center"><?php echo $dat['usuario_correo']?></td>
                                <td class="text-center"><?php echo $dat['roles']?></td>
                                <td>
                                    
                                </td>
                            </tr>
                            <?php
                                }
                            ?>    
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCRUDuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formNuevoUser">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombreeditorial" class="col-form-label">Nombre de usuario:</label>
                            <input type="text" class="form-control" id="nombreusuario">
                        </div>
                        <div class="form-group">
                            <label for="nombreeditorial" class="col-form-label">Contraseña:</label>
                            <input type="password" class="form-control" id="passkusuario">
                        </div>
                        <div class="form-group" id="valcontra" style="display: block">
                            <label for="nombreeditorial" class="col-form-label">Validar contraseña:</label>
                            <input type="password" class="form-control" id="validarpassk">
                        </div>
                        <div class="form-group">
                            <label for="nombreeditorial" class="col-form-label">Nombres:</label>
                            <input type="text" class="form-control" id="nombres">
                        </div>
                        <div class="form-group">
                            <label for="nombreeditorial" class="col-form-label">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos">
                        </div>
                        <div class="form-group">
                            <label for="nombreeditorial" class="col-form-label">DNI:</label>
                            <input type="number" class="form-control" id="dni">
                        </div>
                        <div class="form-group">
                            <label for="nombreeditorial" class="col-form-label">Correo:</label>
                            <input type="email" class="form-control" id="correo">
                        </div>
                        <div class="form-group">
                        <label for="completemobile">Rol:</label>
                        <?php
                            $conn = new mysqli("localhost", "root", "", "meson_db");
                            if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                            }
                            $sql = "SELECT id, descripcion FROM roles";
                            $resultado = $conn->query($sql);
                            echo "<select name='roles' class='form-select' id='rol'>";
                            echo "<option value=''></option>";
                            if ($resultado->num_rows > 0) {
                                while($fila = $resultado->fetch_assoc()) {
                                echo "<option value='" . $fila["id"] . "'>" . $fila["descripcion"] . "</option>";
                                }
                            }
                            echo "</select>";
                            $conn->close();
                        ?>
                    </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark">Enviar</button>
                    </div>
                </form>    
            </div>
            </div>
        </div>
</div>
<?php
        }else{
    ?>    
    <h1>Acceso Denegado, Ud no posee permisos suficientes.</h1>
    <?php
        }
    ?>    

<?php require_once "parte_inferior.php"?>