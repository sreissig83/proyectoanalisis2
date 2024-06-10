<?php require_once "parte_superior.php"?>    
    <?php
       if(($_SESSION["s_idRol"] === 1) && ($_SESSION["s_rol_descripcion"] === "dataentry") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")||($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){ 
        $consulta = "SELECT id_proveedor, razon_social, cuenta_de_pago, contacto, cuit FROM proveedores";
         $resultado = $conexion->prepare($consulta);
         $resultado->execute();
         $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
       }
    ?>
    <?php
        if(($_SESSION["s_idRol"] === 1) && ($_SESSION["s_rol_descripcion"] === "dataentry") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")){
    ?>
            <div class="container-fluid"><h2 class="text-center">Proveedores</h2></div>
            <div class="container">
                <div class="row">
                    <div class="col-log-12">
                        <button id="btnnuevoProov" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
            </div>   
            
            <div class="container">
                <div class="row">
                    <div class="col-log-12">
                        <div class="table-responsive">
                            <table id="tablaproveedores" class="table table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th>Razon Social</th>
                                        <th>CBU</th>
                                        <th>Telefono</th>
                                        <th>Cuit</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($data as $dat) {
                                    ?>    
                                    <tr>
                                        <td class="text-center"><?php echo $dat['id_proveedor']?></td>
                                        <td class="text-center"><?php echo $dat['razon_social']?></td>
                                        <td class="text-center"><?php echo $dat['cuenta_de_pago']?></td>
                                        <td class="text-center"><?php echo $dat['contacto']?></td>
                                        <td class="text-center"><?php echo $dat['cuit']?></td>
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
            
            
            <div class="modal fade" id="modalCRUDproov" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="formProveedores">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nombrecliente" class="col-form-label">Razon Social:</label>
                                <input type="text" class="form-control" id="razonsocial">
                            </div>
                            <div class="form-group">
                                <label for="apellidocliente" class="col-form-label">Cuenta de Pago:</label>
                                <input type="text" class="form-control" id="cuentapago">
                            </div>
                            <div class="form-group">
                                <label for="cuitcliente" class="col-form-label">Contacto:</label>
                                <input type="number" class="form-control" id="contacto">
                            </div>
                            <div class="form-group">
                                <label for="domiciliocliente" class="col-form-label">Cuit:</label>
                                <input type="text" class="form-control" id="cuit">
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
        <div class="container-fluid"><h2 class="text-center">Proveedores</h2></div>
        <div class="container">
                <div class="row">
                    <div class="col-log-12">
                        <div class="table-responsive">
                            <table id="tablaproveedores" class="table table-striped table-bordered table-condensed" style="width:100%">
                                <thead class="text-center">
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th>Razon Social</th>
                                        <th>Cuenta de Pago</th>
                                        <th>Contacto</th>
                                        <th>Cuit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($data as $dat) {
                                    ?>    
                                    <tr>
                                        <td class="text-center"><?php echo $dat['id_proveedor']?></td>
                                        <td class="text-center"><?php echo $dat['razon_social']?></td>
                                        <td class="text-center"><?php echo $dat['cuenta_de_pago']?></td>
                                        <td class="text-center"><?php echo $dat['contacto']?></td>
                                        <td class="text-center"><?php echo $dat['cuit']?></td>
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
    <h1>Acceso Denegado, Ud no posee permisos suficientes.</h1>
    <?php
        }
    ?>    
<?php require_once "parte_inferior.php"?>