
$(document).ready(function(){
     tablaarticulos = $("#tablaarticulos").DataTable({
        "columnDefs":[{
            "targets":  -1,
            "data":null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarArt'><i class='fa-solid fa-pen'></i></button><button class='btn btn-danger btnEliminarArt'><i class='fa-solid fa-trash'></i></button></div></div>"
        }],

        //Cambiar lenguaje a Español
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
    

    $("#btnnuevoArt").click(function(){//Alta
        $("#formArticulos").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color","white");
        $(".modal-title").text("Nuevo Articulo");
        $("#modalCRUDart").modal("show");
        id=null;
        opcion=1;
    });
    var fila; //captura la fila que debe borrar o editar segun se apreta el boton
   
    $(document).on("click", ".btnEditarArt", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        titulo = fila.find('td:eq(1)').text();
        autor = fila.find('td:eq(2)').text();
        editorial = fila.find('td:eq(3)').text();
        isbn = parseInt(fila.find('td:eq(4)').text());
        codbarra = parseInt(fila.find('td:eq(5)').text());
        costo = parseFloat(fila.find('td:eq(6)').text());
        precioventa = parseFloat(fila.find('td:eq(7)').text());
        puntopedidogral = parseInt(fila.find('td:eq(8)').text());
        puntopedidoventa = parseInt(fila.find('td:eq(9)').text());
        
        $("#titulo").val(titulo);
        $("#autor").val(autor);
        $("#editorial").val(editorial);
        $("#isbn").val(isbn);
        $("#codbarras").val(codbarra);
        $("#costo").val(costo);
        $("#precioventa").val(precioventa);
        $("#cantdeposito").val(puntopedidogral);
        $("#cantpuntoventa").val(puntopedidoventa);
        
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color","white");
        $(".modal-title").text("Editar Editorial");
        $("#modalCRUDart").modal("show");
        opcion=2;
    });

    
    $(document).on("click", ".btnEliminarArt", function(){//Eliminar
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3;//editar
        var respuesta = confirm("¿Desea Eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "../db/articuloscrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(data){
                    tablaarticulos.row(fila.parent('tr').remove).draw();
                }
            })
        }
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