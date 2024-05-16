var contadorArticulos = 0;
    function agregarCampoSelect() {
            $.ajax({
                url: "../db/querytitulos.php",
                type: "GET",
                success: function(data) {
                    contadorArticulos++;
                    var nuevoSelectarticulo = '<div class="row justify-content-center align-items-center g-2"><div class="col"><select name="producto[]" class="form-select" id="articulo'+ contadorArticulos + '">' + data + '</select></div><div class="col"><input type="number"  class="form-control" id="cantidad'+ contadorArticulos + '"></input></div></div><br>';
                    $('#contenedorSelects').append(nuevoSelectarticulo);
                }
            });
    }
$(document).ready(function(){
    tablamovimientos = $("#tablamovimientos").DataTable({
       "language": {
           "lengthMenu": "Mostrar _MENU_ registros",
           "zeroRecords": "No se encontraron resultados",
           "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
           "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
           "infoFiltered": "(filtrado de un total de _MAX_ registros" ,
           "sSearch": "Buscar:",
           "oPaginate": {
               "sFirst": "Primero",
               "sLast": "Ultimo",
               "sNext": "Siguiente",
               "sPrevious": "Anterior"
           },
           "sProcessing": "Procesando...",       
       }
   });
   
    

   $("#btnnuevoMov").click(function(){//Alta
       $("#formMovimientos").trigger("reset");
       $(".modal-header").css("background-color", "#28a745");
       $(".modal-header").css("color","white");
       $(".modal-title").text("Nuevo Movimiento");
       $("#modalCRUDmov").modal("show");
       id=null;

    });
    

   $("#formArticulos").submit(function(e){//Envio de los datos al crud.php
       e.preventDefault();
       titulo = $.trim($("#titulo").val());
       autor =  $.trim($("#autor").val());
       editorial = $.trim($("#editorial").val());
       isbn = $.trim($("#isbn").val());
       codbarra = $.trim($("#codbarras").val());
       costo = $.trim($("#costo").val());
       precioventa = $.trim($("#precioventa").val());
       puntopedidogral = $.trim($("#cantdeposito").val());
       puntopedidoventa = $.trim($("#cantpuntoventa").val());
       $.ajax({
           url: "../db/articuloscrud.php",
           type: "POST",
           dataType: "json",
           data: {id:id, titulo:titulo, autor:autor, editorial:editorial, isbn:isbn, codbarra:codbarra, costo:costo, precioventa:precioventa, puntopedidogral:puntopedidogral, puntopedidoventa:puntopedidoventa, opcion:opcion},
           success: function(data){
               id = data[0].id;
               autor = data[0].autor;
               editorial = data[0].editorial;
               isbn = data[0].isbn;
               codbarra = data[0].codbarra;
               costo = data[0].costo;
               precioventa = data[0].precioventa;
               puntopedidogral = data[0].puntopedidogral;
               puntopedidoventa = datos[0].puntopedidoventa;
               if(opcion == 1){
                   tablaarticulos.row.add([id,titulo,autor,editorial,isbn,codbarra,costo,precioventa,puntopedidogral,puntopedidoventa].draw());
               }else{
                   tablaarticulos.row(fila).data([id,titulo,autor,editorial,isbn,codbarra,costo,precioventa,puntopedidogral,puntopedidoventa].draw());
               };
               
           }
       })
       $("#modalCRUDart").modal("hide");
       
   });      
})

