$(document).ready(function(){
    $('#formlogin').submit(function(e){
        e.preventDefault();
        var usuario = $.trim($('#usuario').val());
        var password = $.trim($('#password').val());
        if(usuario.length == "" || password == ""){
            Swal.fire({
                icon:'warning',
                title:'Debe ingresar un usuario/password valido',
            });
            return false;
        }else{
            $.ajax({
                url: "db/login.php",
                type:"POST",
                datatype: "json",
                data: {usuario:usuario, password:password},
                success:function(data){
                    
                    if(data == "null"){
                        Swal.fire({
                            icon:'error',
                            title:'Usuario y/o password incorrecto',
                        });
                    }else{
                        Swal.fire({
                            icon:'success',
                            title:'¡Conexion exitosa!',
                        }).then((result) => {
                            if(result.value){
                                if(typeof window !== "undefined"){
                                    window.location.href = "views/home.php";
                                }
                            }
                        })
                    }
                }
            }
            );
        }
    })
});
