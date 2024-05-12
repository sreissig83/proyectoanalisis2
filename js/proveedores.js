$(document).ready(function(){
    tablaproveedores = $("#tablaproveedores").DataTable({
        "columnDefs":[{
            "targets":  -1,
            "data":null,
            "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnEliminar'>Eliminar</button></div></div>"
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
    
    $("#btnnuevo").click(function(){//Alta
        $("#formProveedores").trigger("reset");
        $(".modal-header").css("background-color", "#28a745");
        $(".modal-header").css("color","white");
        $(".modal-title").text("Nuevo Proveedor");
        $("#modalCRUD").modal("show");
        id=null;
        opcion=1;
    });  
    
    var fila; //captura la fila que sebe borrar o editar segun se apreta el boton
    //Boton Editar
    $(document).on("click", ".btnEditar", function(){//Editar
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        razonsocial = fila.find('td:eq(1)').text();
        cuentapago = fila.find('td:eq(2)').text();
        contacto = parseInt(fila.find('td:eq(3)').text());
        cuit = parseInt(fila.find('td:eq(4)').text());
        $("#razonsocial").val(razonsocial);
        $("#cuantapago").val(cuentapago);
        $("#contacto").val(contacto);
        $("#cuit").val(cuit);
        opcion = 2;
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color","white");
        $(".modal-title").text("Editar Proveedor");
        $("#modalCRUD").modal("show");
    });

    
    $(document).on("click", ".btnEliminar", function(){//Eliminar
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3;//editar
        var respuesta = confirm("¿Desea Eliminar el registro: "+id+"?");
        if(respuesta){
            $.ajax({
                url: "db/proveedorescrud.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(data){
                    tablaproveedores.row(fila.parent('tr').remove).draw();
                }
            })
        }
    });
    
    
    $("#formProveedores").submit(function(e){//Envio de los datos al crud.php
        e.preventDefault();
        razonsocial = $.trim($("#razonsocial").val());
        cuentapago =  $.trim($("#cuentapago").val());
        contacto = $.trim($("#contacto").val());
        cuit = $.trim($("#cuit").val());
        $.ajax({
            url: "db/proveedorescrud.php",
            type: "POST",
            dataType: "json",
            data: {id:id, razonsocial:razonsocial, cuentapago:cuentapago, contacto:contacto, cuit:cuit, opcion:opcion},
            success: function(data){
                id = datos[0].id;
                razonsocial = data[0].razonsocial;
                cuentapago = data[0].cuentapago;
                contacto = data[0].contacto;
                cuit = data[0].cuit;
                if(opcion == 1){
                    tablaproveedores.row.add([id,razonsocial,cuentapago,contacto,cuit].draw());
                }else{
                    tablaproveedores.row(fila).data([id,razonsocial,cuentapago,contacto,cuit].draw());
                };
                
            }
        })
        $("#modalCRUD").modal("hide");
    });      
})