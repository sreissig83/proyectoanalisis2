<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Meson de Libros</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">

</head>
<body>
    <div id="login">
        <h3 id="titlelogin" class="text-center text-white display-4">Meson de Libros</h3>
        <div class="container-fluid">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-4">
                    <div id="login-box" class="col-md-12 bg-light text-dark">
                        <form id="formlogin" class="form" action="" method="post">
                            <h3 class="text-center text-dark">Iniciar Sesion</h3>
                            <div class="form-group">
                                <label for="usuario" class="text-dark">Usuario</label>
                                <input type="text" name="usuario" id="usuario" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" name="submit" class=" btn btn-dark btn-lg" value="Conectar">
                            </div>
                        </form> 
                        <div class="row justify-content-md-center">
                            <div class="col-md-12">
                                <a  id="helplogin" class=" btn btn-secondary btn-sm" value="Ayuda" href="helplogin.html" target="_blank">Ayuda</a>
                            </div>
                            </div>
                        </div>
                    </div>         
                    </div>
                    </div>
                    
                    </div> 
        </div>
    </div>  
    
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="popper/popper.min.js"></script>

    <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>