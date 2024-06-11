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
    var userrol = $.trim($("#useridrol").val());
    var usedescript = $.trim($("#userdescrip").val());
    if((userrol == 2 & usedescript == "deposito")||(userrol == 4 & usedescript == "admin")||(userrol == 3 & usedescript == "venta") ){
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
    
        

    $("#btnnuevoMov").click(function(){
        $("#formMovimientos").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color","white");
        $(".modal-title").text("Nuevo Movimiento");
        $("#modalCRUDmov").modal("show");
        id=null;

        });
        
        
                

        $.ajax({
            url: "../db/queryorigenmov.php",
            type: "GET", 
            success: function(data) {
                $("#origenmov").html(data);
            }
        });
        
        $("#origenmov").change(function() {
            var origen = $(this).val();
            if(origen !== "") {
                $("#destinomov").prop("disabled", false);
                $.ajax({
                    url: "../db/querydestinomov.php",
                    type: "GET",
                    data: {origen: origen},
                    success: function(data) {
                        $("#destinomov").html(data);
                        $("#destinomov option[value='" + origen + "']").remove();
                    }
                });
            } else {
                $("#destinomov").prop("disabled", true);
            }
        });  
    $("#formMovimientos").submit(function(e){
        e.preventDefault();
        fechamov = formatearFechamov();
        usuario = $.trim($("#usuario").val());
        origen = $.trim($("#origenmov").val());
        destino = $.trim($("#destinomov").val());
        articulo1 = $.trim($("#articulo1").val());
        cantidad1 = parseInt($.trim($("#cantidad1").val()));
        articulo2 = $.trim($("#articulo2").val());
        cantidad2 = parseInt($.trim($("#cantidad2").val()));
        articulo3 = $.trim($("#articulo3").val());
        cantidad3 = parseInt($.trim($("#cantidad3").val()));
        articulo4 = $.trim($("#articulo4").val());
        cantidad4 = parseInt($.trim($("#cantidad4").val()));
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
                    fecha = data[0].fecha;
                    usuario = data[0].usuario;
                    origen = data[0].origen;
                    destino = data[0].destino;
                    articulo = data[0].articulo;
                    cantidad = data[0].cantidad;
                    tablamovimientos.row.add([id,fecha,usuario,origen,destino,articulo,cantidad].draw());   
                }
            })
            $("#modalCRUDmov").modal("hide");
    
    });
    }else if(userrol == 5 & usedescript == "lector"){
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
    };
})

