var contadorArticulos = 0;
    function agregarCampoSelect() {
            $.ajax({
                url: "../db/querytitulos.php",
                type: "GET",
                success: function(data) {
                    if(contadorArticulos <= 4){
                    contadorArticulos++;
                    var nuevoSelectarticulo = '<div class="row justify-content-center align-items-center g-2" id="conteinerAgregarprod'+ contadorArticulos + '"><div class="col"><select  name="producto[]" class="form-select" id="articulo'+ contadorArticulos + '">' + data + '</select></div><div class="col"><input type="number"  class="form-control" id="cantidad'+ contadorArticulos + '"></input></div></div><br>';
                    $('#contenedorSelects').append(nuevoSelectarticulo);
                    }else{
                        Swal.fire({
                            icon:'error',
                            title:'Solo se permiten hasta 5 articulos por movimiento.',
                        });
                    }
                }
            });
    }
function formatearFechamov() {
    var fecha = document.getElementById("fecha").value;
    var fechamov = fecha.replace("T", " ") + ":00";
    return fechamov;
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
    
    
              


   $("#formMovimientos").submit(function(e){//Envio de los datos al crud.php
       e.preventDefault();
       fechamov = formatearFechamov();
       usuario = $.trim($("#usuario").val());
       origen = $("#movorigen").val();
       destino = $("#movdestino").val();
       articulo1 = $("#articulo1").val();
       cantidad1 = parseInt($.trim($("#cantidad1").val()));
       articulo2 = $.trim($("#articulo2").val());
       cantidad2 = parseInt($.trim($("#cantidad2").val()));
       articulo3 = $.trim($("#articulo3").val());
       cantidad3 = parseInt($.trim($("#cantidad4").val()));
       articulo4 = $.trim($("#articulo4").val());
       cantidad4 = parseInt($.trim($("#cantidad5").val()));
       articulo5 = $.trim($("#articulo5").val());
       cantidad5 = parseInt($.trim($("#cantidad5").val()));
       console.log(articulo1);
       console.log(articulo2);
       $.ajax({
            url: "../db/movimientoscrud.php",
            type: "POST",
            dataType: "json",
            data: { fechamov:fechamov, usuario:usuario, origen:origen, destino:destino, articulo1:articulo1, cantidad1:cantidad1, articulo2:articulo2, cantidad2:cantidad2, articulo3:articulo3, cantidad3:cantidad3, articulo4:articulo4, cantidad4:cantidad4, articulo5:articulo5, cantidad5:cantidad5, contadorArticulos:contadorArticulos },
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
                tablamovimientos.row.add([id,titulo,autor,editorial,isbn,codbarra,costo,precioventa,puntopedidogral,puntopedidoventa].draw());   
            }
        })
        $("#modalCRUDmov").modal("hide");
       
       
       
   });
    
})

