$(document).ready(function(){
    tablausuarios = $("#tablausuarios").DataTable({
       "columnDefs":[{
           "targets":  -1,
           "data":null,
           "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditarUser'><i class='fa-solid fa-pen'></i></button><button class='btn btn-danger btnEliminarUser'><i class='fa-solid fa-trash'></i></button></div></div>"
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
   
   $("#btnnuevoUser").click(function(){
       $("#formNuevoUser").trigger("reset");
       $(".modal-header").css("background-color", "#28a745");
       $(".modal-header").css("color","white");
       $(".modal-title").text("Nuevo Usuario");
       $("#modalCRUDuser").modal("show");
    
       id=null;
       opcion=1;
   });
   
   var fila;
  

   $(document).on("click", ".btnEditarUser", function(){
       fila = $(this).closest("tr");
       id = parseInt(fila.find('td:eq(0)').text());
       nombreusuario = fila.find('td:eq(1)').text();
       passkkusuario = fila.find('td:eq(2)').text();
       nombres = fila.find('td:eq(3)').text();
       apellidos = fila.find('td:eq(4)').text();
       dni = parseInt(fila.find('td:eq(5)').text());
       correo = fila.find('td:eq(6)').text();
       rol = fila.find('td:eq(7)').text();
       document.getElementById("valcontra").style.display = "none";

       $("#nombreusuario").val(nombreusuario);
       $("passkusuario").val(passkusuario);
       $("#nombres").val(nombres);
       $("#apellidos").val(apellidos);
       $("#dni").val(dni);
       $("#correo").val(correo);
       $("#rol").val(rol);
    
       $(".modal-header").css("background-color", "#007bff");
       $(".modal-header").css("color","white");
       $(".modal-title").text("Modificar Usuario");
       $("#modalCRUDuser").modal("show");
       opcion=2;
   });

   
   $(document).on("click", ".btnEliminarUser", function(){
       fila = $(this);
       id = parseInt($(this).closest("tr").find('td:eq(0)').text());
       opcion = 3;
       var respuesta = confirm("¿Desea Eliminar el registro: "+id+"?");
       if(respuesta){
           $.ajax({
               url: "../db/usuarioscrud.php",
               type: "POST",
               dataType: "json",
               data: {opcion:opcion, id:id},
               success: function(data){
                   tablausuarios.row(fila.parent('tr').remove).draw();
               }
           });
           
       }
        
   });
   
   
   $("#formNuevoUser").submit(function(e){
       e.preventDefault();
       nombreusuario= $.trim($("#nombreusuario").val());
       passkusuario =  $.trim($("#passkusuario").val());
       if(opcion == 2){
        nombres = $.trim($("#nombres").val());
        apellidos = $.trim($("#apellidos").val());
        dni = $.trim($("#dni").val());
        correo = $.trim($("#correo").val());
        rol = $.trim($("#rol").val());
        $.ajax({
           url: "../db/usuarioscrud.php",
           type: "POST",
           dataType: "json",
           data: {id:id, nombreusuario:nombreusuario, passkusuario:passkusuario, nombres:nombres, apellidos:apellidos, dni:dni, correo:correo, rol:rol, opcion:opcion},
           success: function(data){
               id = data[0].id;
               nombreusuario = data[0].nombreusuario;
               passkkusuario = data[0].passkkusuario;
               nombres = data[0].nombres;
               apellidos = data[0].apellidos;
               dni = data[0].dni;
               correo = data[0].correo;
               rol = data[0].rol;
               tablausuarios.row(fila).data([id,nombreusuario,passkusuario,nombres,apellidos,dni,correo,rol].draw());   
           }
       });
       $("#modalCRUDuser").modal("hide");
       }else{
            alert("ingresa");
            valpasskusuario= $.trim($("#validarpassk").val());
            if(passkusuario != valpasskusuario){
                Swal.fire({
                    icon:'error',
                    title:'Las contraseñas no concuerdan.',
                });
                return;
            }else{
                nombres = $.trim($("#nombres").val());
                apellidos = $.trim($("#apellidos").val());
                dni = $.trim($("#dni").val());
                correo = $.trim($("#correo").val());
                rol = $.trim($("#rol").val());
                $.ajax({
                url: "../db/usuarioscrud.php",
                type: "POST",
                dataType: "json",
                data: {id:id, nombreusuario:nombreusuario, passkusuario:passkusuario, nombres:nombres, apellidos:apellidos, dni:dni, correo:correo, rol:rol, opcion:opcion},
                success: function(data){
                    id = data[0].id;
                    nombreusuario = data[0].nombreusuario;
                    passkkusuario = data[0].passkkusuario;
                    nombres = data[0].nombres;
                    apellidos = data[0].apellidos;
                    dni = data[0].dni;
                    correo = data[0].correo;
                    rol = data[0].rol;
                    if(opcion == 1){
                        tablausuarios.row.add([id,nombreusuario,passkusuario,nombres,apellidos,dni,correo,rol].draw());
                    }else{
                        tablausuarios.row(fila).data([id,nombreusuario,passkusuario,nombres,apellidos,dni,correo,rol].draw());
                    };
                    
                }
            });
            $("#modalCRUDuser").modal("hide");
        };
       };
       
       });      
})
    
