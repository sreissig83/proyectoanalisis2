<?php require_once "parte_superior.php"?>
<?php
    include_once '../db/conexioncrud.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    $consulta = "SELECT id_articulo, Titulo, Autor, Id_editorial, ISBN, cod_barra, costo, precio_venta, punto_pedido_gral, punto_pedido_venta FROM articulo";
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

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


<?php require_once "parte_inferior.php"?>