<?php require_once "parte_superior.php"?>
<?php

    $consulta = "SELECT usuario_nombres, usuario_apellidos, usuario_dni, usuario_correo FROM usuarios WHERE usuario_uname='" . $_SESSION["s_usuario"] . "'";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

?> 
<?php
foreach($data as $dat) {
?> 
<div class="container">
    <div class="row align.items-center text-center">
        <div class="col-md-4">
            <h4>Usuario:</h4>
            <span><?php echo $_SESSION["s_usuario"];?></span>
        </div>
        <div class="col-md-4">
            <h4>Id de Rol:</h4>
            <span><?php echo $_SESSION["s_idRol"];?></span>
        </div>       
        <div class="col-md-4">
            <h4>Rol:</h4>
            <span><?php echo $_SESSION["s_rol_descripcion"];?></span>
        </div>
    </div>
    <div class="row align.items-center text-center">
            <div class="col-md-4">
                <h4>Nombre:</h4>
                <span><?php echo $dat['usuario_nombres']?></span>
            </div>
            <div class="col-md-4">
                <h4>Apellido:</h4>
                <span><?php echo $dat['usuario_apellidos']?></span>
            </div>       
            <div class="col-md-4">
                <h4>DNI:</h4>
                <span><?php echo $dat['usuario_dni']?></span>
            </div>
            <div class="col-md-4">
                <h4>Correo:</h4>
                <span><?php echo $dat['usuario_correo']?></span>
            </div>
    </div>

</div>
<?php
                                }
?>  

<?php require_once "parte_inferior.php"?>

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