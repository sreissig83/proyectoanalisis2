$(document).ready(function(){
    var userrol = $.trim($("#useridrol").val());
    var usedescript = $.trim($("#userdescrip").val());
    if((userrol == 1 & usedescript == "dataentry")||(userrol == 4 & usedescript == "admin") ){    
        tablaclientes = $("#tablaclientes").DataTable({
            "columnDefs":[{
                "targets":  -1,
                "data":null,
                "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarCli'><i class='fa-solid fa-pen'></i></button><button class='btn btn-danger btnEliminarCli'><i class='fa-solid fa-trash'></i></button></div></div>"
            }],

        
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
        
        $("#btnnuevoCli").click(function(){
            $("#formClientes").trigger("reset");
            $(".modal-header").css("background-color", "#28a745");
            $(".modal-header").css("color","white");
            $(".modal-title").text("Nueva Cliente");
            $("#modalCRUDcli").modal("show");
            id=null;
            opcion=1;
        });  
        
        var fila; 
        $(document).on("click", ".btnEditarCli", function(){
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text());
            nombre = fila.find('td:eq(1)').text();
            apellido = fila.find('td:eq(2)').text();
            cuit = parseInt(fila.find('td:eq(3)').text());
            domicilio = fila.find('td:eq(4)').text();
            $("#nombre").val(nombre);
            $("#apellido").val(apellido);
            $("#cuit").val(cuit);
            $("#domicilio").val(domicilio);
            opcion = 2;
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color","white");
            $(".modal-title").text("Editar Cliente");
            $("#modalCRUDcli").modal("show");
        });

        
        $(document).on("click", ".btnEliminarCli", function(){
            fila = $(this);
            id = parseInt($(this).closest("tr").find('td:eq(0)').text());
            opcion = 3;//editar
            var respuesta = confirm("¿Desea Eliminar el registro: "+id+"?");
            if(respuesta){
                $.ajax({
                    url: "../db/clientescrud.php",
                    type: "POST",
                    dataType: "json",
                    data: {opcion:opcion, id:id},
                    success: function(data){
                        tablaclientes.row(fila.parent('tr').remove).draw();
                    }
                });
            }
        });
        
        
        $("#formClientes").submit(function(e){
            e.preventDefault();
            nombre = $.trim($("#nombre").val());
            apellido =  $.trim($("#apellido").val());
            cuit = $.trim($("#cuit").val());
            domicilio = $.trim($("#domicilio").val());
            $.ajax({
                url: "../db/clientescrud.php",
                type: "POST",
                dataType: "json",
                data: {id:id, nombre:nombre, apellido:apellido, cuit:cuit, domicilio:domicilio, opcion:opcion},
                success: function(data){
                    id = datos[0].id;
                    nombre = data[0].nombre;
                    apellido = data[0].apelido;
                    cuit = data[0].cuit;
                    domicilio = data[0].domicilio;
                    if(opcion == 1){
                        tablaclientes.row.add([id,nombre,apellido,cuit,domicilio].draw());
                    }else{
                        tablaclientes.row(fila).data([id,nombre,apellido,cuit,domicilio].draw());
                    };
                    
                }
            })
            $("#modalCRUDcli").modal("hide");
            
        });
    }else if(userrol == 5 & usedescript == "lector"){ 
        tablaclientes = $("#tablaclientes").DataTable({
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