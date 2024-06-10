<?php require_once "parte_superior.php"?>
<?php
   

    if(($_SESSION["s_idRol"] === 1) && ($_SESSION["s_rol_descripcion"] === "dataentry") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")||($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){
            $consulta = "SELECT a.id_articulo, a.Titulo, a.Autor, e.Nombre, a.ISBN, a.cod_barra, a.costo, a.precio_venta, a.punto_pedido_gral, a.punto_pedido_venta FROM articulo a JOIN editorial e ON a.Id_editorial = e.Id_editorial";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    }
?> 
<?php
        if(($_SESSION["s_idRol"] === 1) && ($_SESSION["s_rol_descripcion"] === "dataentry") ||($_SESSION["s_idRol"] === 4) && ($_SESSION["s_rol_descripcion"] === "admin")){
?>

    <div class="container-fluid"><h2 class="text-center">Articulos</h2></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-log-12">
                <button id="btnnuevoArt" type="button" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
            </div>
        </div>
    </div>
    
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="tablaarticulos" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th class="text-center">Id</th>
                                <th>Titulo</th>
                                <th>Autor</th>
                                <th>Editorial</th>
                                <th>ISBN</th>
                                <th>Codigo de Barras</th>
                                <th>Costo</th>
                                <th>Precio de Venta</th>
                                <th>Cantidad en Deposito</th>
                                <th>Cantidad en Punto de Venta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($data as $dat) {
                            ?>    
                            <tr>
                                <td class="text-center"><?php echo $dat['id_articulo']?></td>
                                <td class="text-center"><?php echo $dat['Titulo']?></td>
                                <td class="text-center"><?php echo $dat['Autor']?></td>
                                <td class="text-center"><?php echo $dat['Nombre']?></td>
                                <td class="text-center"><?php echo $dat['ISBN']?></td>
                                <td class="text-center"><?php echo $dat['cod_barra']?></td>
                                <td class="text-center"><?php echo $dat['costo']?></td>
                                <td class="text-center"><?php echo $dat['precio_venta']?></td>
                                <td class="text-center"><?php echo $dat['punto_pedido_gral']?></td>
                                <td class="text-center"><?php echo $dat['punto_pedido_venta']?></td>
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
    
    
    <div class="modal fade" id="modalCRUDart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formArticulos">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo" class="col-form-label">Titulo:</label>
                        <input type="text" class="form-control" id="titulo">
                    </div>
                    <div class="form-group">
                        <label for="autor" class="col-form-label">Autor:</label>
                        <input type="text" class="form-control" id="autor">
                    </div>
                    <div class="form-group">
                        <label for="completemobile">Editorial</label>
                        <?php
                            
                            $conn = new mysqli("localhost", "root", "", "meson_db");
                            if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                            }
                            $sql = "SELECT Id_editorial, Nombre FROM editorial";
                            $resultado = $conn->query($sql);
                            echo "<select name='editoriallibro' class='form-select' id='editorial'>";
                            echo "<option value=''></option>";
                            if ($resultado->num_rows > 0) {
                                while($fila = $resultado->fetch_assoc()) {
                                echo "<option value='" . $fila["Id_editorial"] . "'>" . $fila["Nombre"] . "</option>";
                                }
                            }
                            echo "</select>";
                            $conn->close();
                        ?>
                    </div>
                
                    <div class="form-group">
                        <label for="isbn" class="col-form-label">ISBN:</label>
                        <input type="number" class="form-control" id="isbn">
                    </div>
                    <div class="form-group">
                        <label for="codbarras" class="col-form-label">Codigo de Barras:</label>
                        <input type="number" class="form-control" id="codbarras">
                    </div>
                    <div class="form-group">
                        <label for="costo" class="col-form-label">Costo $:</label>
                        <input type="number" class="form-control" id="costo">
                    </div>
                    <div class="form-group">
                        <label for="precioventa" class="col-form-label">Precio de Venta $:</label>
                        <input type="number" class="form-control" id="precioventa">
                    </div>
                    <div class="form-group">
                        <label for="cantdeposito" class="col-form-label">Cantidad en Deposito:</label>
                        <input type="number" class="form-control" id="cantdeposito">
                    </div>
                    <div class="form-group">
                        <label for="cantpuntoventa" class="col-form-label">Cantidad en Punto de Venta:</label>
                        <input type="number" class="form-control" id="cantpuntoventa">
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
      
      <?php
        }else if(($_SESSION["s_idRol"] === 5) && ($_SESSION["s_rol_descripcion"] === "lector")){
    ?>  
    <div class="container-fluid"><h2 class="text-center">Articulos</h2></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="tablaarticulos" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th class="text-center">Id</th>
                                <th>Titulo</th>
                                <th>Autor</th>
                                <th>Editorial</th>
                                <th>ISBN</th>
                                <th>Codigo de Barras</th>
                                <th>Costo</th>
                                <th>Precio de Venta</th>
                                <th>Cantidad en Deposito</th>
                                <th>Cantidad en Punto de Venta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($data as $dat) {
                            ?>    
                            <tr>
                                <td class="text-center"><?php echo $dat['id_articulo']?></td>
                                <td class="text-center"><?php echo $dat['Titulo']?></td>
                                <td class="text-center"><?php echo $dat['Autor']?></td>
                                <td class="text-center"><?php echo $dat['Nombre']?></td>
                                <td class="text-center"><?php echo $dat['ISBN']?></td>
                                <td class="text-center"><?php echo $dat['cod_barra']?></td>
                                <td class="text-center"><?php echo $dat['costo']?></td>
                                <td class="text-center"><?php echo $dat['precio_venta']?></td>
                                <td class="text-center"><?php echo $dat['punto_pedido_gral']?></td>
                                <td class="text-center"><?php echo $dat['punto_pedido_venta']?></td>
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