<?php require_once "parte_superior.php"?>
    
    <?php
    if(($_SESSION["s_idRol"] === 1) && ($_SESSION["s_rol_descripcion"] === "dataentry") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")||($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){
        $consulta = "SELECT id_cliente, Nombre, Apellido, CUIT, Domicilio FROM cliente";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    };

    ?>
    <?php
        if(($_SESSION["s_idRol"] === 1) && ($_SESSION["s_rol_descripcion"] === "dataentry") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")){
    ?> 
        <div class="container-fluid"><h2 class="text-center">Clientes</h2></div>
        <div class="container">
            <div class="row">
                <div class="col-log-12">
                    <button id="btnnuevoCli" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                </div>
            </div>
        </div>   
        
        
        <div class="container">
            <div class="row">
                <div class="col-log-12">
                    <div class="table-responsive">
                        <table id="tablaclientes" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>CUIT</th>
                                    <th>Domicilio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($data as $dat) {
                                ?>    
                                <tr>
                                    <td class="text-center"><?php echo $dat['id_cliente']?></td>
                                    <td class="text-center"><?php echo $dat['Nombre']?></td>
                                    <td class="text-center"><?php echo $dat['Apellido']?></td>
                                    <td class="text-center"><?php echo $dat['CUIT']?></td>
                                    <td class="text-center"><?php echo $dat['Domicilio']?></td>
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
        
        
        <div class="modal fade" id="modalCRUDcli" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formClientes">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombrecliente" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>
                        <div class="form-group">
                            <label for="apellidocliente" class="col-form-label">Apellido:</label>
                            <input type="text" class="form-control" id="apellido">
                        </div>
                        <div class="form-group">
                            <label for="cuitcliente" class="col-form-label">CUIT:</label>
                            <input type="number" class="form-control" id="cuit">
                        </div>
                        <div class="form-group">
                            <label for="domiciliocliente" class="col-form-label">Domicilio:</label>
                            <input type="text" class="form-control" id="domicilio">
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
        }else if(($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){
    ?>
    <div class="container-fluid"><h2 class="text-center">Clientes</h2></div>
    <div class="container">
            <div class="row">
                <div class="col-log-12">
                    <div class="table-responsive">
                        <table id="tablaclientes" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>CUIT</th>
                                    <th>Domicilio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($data as $dat) {
                                ?>    
                                <tr>
                                    <td class="text-center"><?php echo $dat['id_cliente']?></td>
                                    <td class="text-center"><?php echo $dat['Nombre']?></td>
                                    <td class="text-center"><?php echo $dat['Apellido']?></td>
                                    <td class="text-center"><?php echo $dat['CUIT']?></td>
                                    <td class="text-center"><?php echo $dat['Domicilio']?></td>
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
    <?php
        }else{
    ?>
    <h1>Acceso Denegado, Ud no posee permisos susficientes.</h1>
    <?php
        }
    ?>
<?php require_once "parte_inferior.php"?>