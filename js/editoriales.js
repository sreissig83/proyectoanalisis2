$(document).ready(function(){
    tablaeditoriales = $("#tablaeditoriales").DataTable({
        "columnDefs":[{
            "targets":  -1,
            "data":null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditaredit'><i class='fa-solid fa-pen'></i></button><button class='btn btn-danger btnEliminaredit'><i class='fa-solid fa-trash'></i></button></div></div>"
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
    
    $("#btnnuevoEdit").click(function(){//Alta
        $("#formEditoriales").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color","white");
        $(".modal-title").text("Nueva Editorial");
        $("#modalCRUDedit").modal("show");
        id=null;
        opcion=1;
    });  
    
    var fila; //captura la fila que sebe borrar o editar segun se apreta el boton
    //Boton Editar
    $(document).on("click", ".btnEditaredit", function(){//Editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        nombre = fila.find('td:eq(1)').text();
        
        $("#nombre").val(nombre);
        opcion = 2;
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color","white");
        $(".modal-title").text("Editar Editorial");
        $("#modalCRUDedit").modal("show");
    });

    
    $(document).on("click", ".btnEliminaredit", function(){//Eliminar
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3;//editar
        var respuesta = confirm("¿Desea Eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "../db/editorialescrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tablaeditoriales.row(fila.parent('tr').remove).draw();
                }
            })
        }
    });
    
    
    $("#formEditoriales").submit(function(e){//Envio de los datos al crud.php
        e.preventDefault();
        //id = $.trim($("id").val());
        nombre = $.trim($("#nombre").val());
        $.ajax({
            url: "../db/editorialescrud.php",
            type: "POST",
            dataType: "json",
            data: {nombre:nombre, id:id, opcion:opcion},
            success: function(data){
                id = datos[0].id;
                nombre = data[0].nombre;
                if(opcion == 1){
                    tablaeditoriales.row.add([id,nombre].draw());
                }else{
                    tablaeditoriales.row(fila).data([id,nombre].draw());
                };
                
            }
        })
        $("#modalCRUDedit").modal("hide");
    });      
});