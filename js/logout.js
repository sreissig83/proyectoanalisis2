function logout(){
     const logout = 1;
    $(document).ready(function(){
                    $.ajax({
                    url: "../db/logout.php",
                    type:"POST",
                    datatype: "json",
                    data: {logout:logout},
                    success:function(data){
                        if(data == 1){
                            Swal.fire({
                                icon:'success',
                                title:'¡Hasta la proxima!',
                            }).then((result) => {
                                if(result.value){
                                    if (typeof window !== "undefined"){
                                        window.location.href = "../index.php";
                                    }
                                }
                            })
                        };    
                        },
                            
                        });
    });
};