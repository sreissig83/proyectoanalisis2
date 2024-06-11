<?php require_once "parte_superior.php"?> 
<?php
    if(($_SESSION["s_idRol"] === 1) && ($_SESSION["s_rol_descripcion"] === "dataentry") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")||($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){
                $consulta = "SELECT Id_editorial, Nombre FROM editorial";
                $resultado = $conexion->prepare($consulta);
                $resultado->execute();
                $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    };

    ?>
    <?php
        if(($_SESSION["s_idRol"] === 1) && ($_SESSION["s_rol_descripcion"] === "dataentry") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")){
    ?>   
        <div class="container-fluid"><h2 class="text-center">Editoriales</h2></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-1 col-sm-6 text-left"> 
                    <button id="btnnuevoArt" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
                </div>
                    <div class="col-lg-11 col-sm-6 text-right">
                        <a id="helpeditoriales" class="btn btn-info" href="./helpeditoriales.html" target="_blank">Ayuda</a>
                    </div>
            </div>
            </div>   
        
        <div class="container">
            <div class="row">
                <div class="col-log-12">
                    <div class="table-responsive">
                        <table id="tablaeditoriales" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($data as $dat) {
                                ?>    
                                <tr>
                                    <td class="text-center"><?php echo $dat['Id_editorial']?></td>
                                    <td class="text-center"><?php echo $dat['Nombre']?></td>
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
        
        <div class="modal fade" id="modalCRUDedit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formEditoriales">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nombreeditorial" class="col-form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre">
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>    
            </div>
            </div>
        </div>
    </div>
    <?php
        }else if(($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){
            ?>    
                <div class="container-fluid"><h2 class="text-center">Editorialess</h2></div>
                <div class="container">
                    <div class="row">
                        <div class="col-log-12">
                            <div class="table-responsive">
                                <table id="tablaeditoriales" class="table table-striped table-bordered table-condensed" style="width:100%">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">Id</th>
                                            <th>Nombre</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach($data as $dat) {
                                        ?>    
                                        <tr>
                                            <td class="text-center"><?php echo $dat['Id_editorial']?></td>
                                            <td class="text-center"><?php echo $dat['Nombre']?></td>
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