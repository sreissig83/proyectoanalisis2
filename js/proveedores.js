$(document).ready(function(){
    var userrol = $.trim($("#useridrol").val());
    var usedescript = $.trim($("#userdescrip").val());
    if((userrol == 1 & usedescript == "dataentry")||(userrol == 4 & usedescript == "admin") ){
        tablaproveedores = $("#tablaproveedores").DataTable({
            "columnDefs":[{
                "targets":  -1,
                "data":null,
                "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarProov'><i class='fa-solid fa-pen'></i></button><button class='btn btn-danger btnEliminarProov'><i class='fa-solid fa-trash'></i></button></div></div>"
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
        
        $("#btnnuevoProov").click(function(){
            $("#formProveedores").trigger("reset");
            $(".modal-header").css("background-color", "#28a745");
            $(".modal-header").css("color","white");
            $(".modal-title").text("Nuevo Proveedor");
            $("#modalCRUDproov").modal("show");
            id=null;
            opcion=1;
        });  
        
        var fila; 
        $(document).on("click", ".btnEditarProov", function(){
            fila = $(this).closest("tr");
            id = parseInt(fila.find('td:eq(0)').text());
            razonsocial = fila.find('td:eq(1)').text();
            cuentapago = fila.find('td:eq(2)').text();
            contacto = parseInt(fila.find('td:eq(3)').text());
            cuit = parseInt(fila.find('td:eq(4)').text());
            $("#razonsocial").val(razonsocial);
            $("#cuentapago").val(cuentapago);
            $("#contacto").val(contacto);
            $("#cuit").val(cuit);
            opcion = 2;
            $(".modal-header").css("background-color", "#007bff");
            $(".modal-header").css("color","white");
            $(".modal-title").text("Editar Proveedor");
            $("#modalCRUDproov").modal("show");
        });

        
        $(document).on("click", ".btnEliminarProov", function(){
            fila = $(this);
            id = parseInt($(this).closest("tr").find('td:eq(0)').text());
            opcion = 3;
            var respuesta = confirm("¿Desea Eliminar el registro: "+id+"?");
            if(respuesta){
                $.ajax({
                    url: "../db/proveedorescrud.php",
                    type: "POST",
                    dataType: "json",
                    data: {opcion:opcion, id:id},
                    success: function(data){
                        tablaproveedores.row(fila.parent('tr').remove).draw();
                    }
                });
                
            }
        });

        
        
        
        $("#formProveedores").submit(function(e){
            e.preventDefault();
            razonsocial = $.trim($("#razonsocial").val());
            cuentapago =  $.trim($("#cuentapago").val());
            contacto = $.trim($("#contacto").val());
            cuit = $.trim($("#cuit").val());
            $.ajax({
                url: "../db/proveedorescrud.php",
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
            $("#modalCRUDproov").modal("hide");
            
        });
    }else if(userrol == 5 & usedescript == "lector"){
        tablaproveedores = $("#tablaproveedores").DataTable({
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