<?php
    function head($ua = null){
        !is_null($ua) ? $ua->sessionValidate() : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/cisnatura/resources/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="/cisnatura/resources/img/logocis.jpg" type="image/x-icon">
    <title>Cisnatura Tienda</title>
</head>
<body>
<!-- navbar navbar-expand-lg navbar-light bg-white bg-gradient mb-3 shadow sticky-top -->
    <div id="app" class="container-fluid p-0">
        <header>        
            <nav class="navbar navbar-expand-lg shadow" data-bs-theme="light">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand ml-3 mt-2 d-lg-none" href="/cisnatura/index.php">
                        <img src="/cisnatura/resources/img/logocis.jpg" alt="Logo" height="70">
                    </a>
                    <a class="navbar-brand ml-3 d-none d-lg-block" href="/cisnatura/index.php">
                        <img src="/cisnatura/resources/img/logocis.jpg" height="100" alt="Logo">
                    </a>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">                        
                        <ul class="navbar-nav me-auto mb-0 mb-lg-0">
                            <li class="nav-item">
                                <a class="btn btn-success rounded-pill m-1 m-1"
                                        aria-current="page" 
                                        href="/cisnatura/resources/views/home.php"
                                        style="transition: transform 0.3s;"
                                        onmouseover="this.style.transform = 'scale(1.1)';"
                                        onmouseout="this.style.transform = 'scale(1)';"
                                        >Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-success rounded-pill m-1 m-1"
                                        aria-current="page" 
                                        href="/cisnatura/resources/views/catalogo.php"
                                        style="transition: transform 0.3s;"
                                        onmouseover="this.style.transform = 'scale(1.1)';"
                                        onmouseout="this.style.transform = 'scale(1)';"
                                        >Catálogo</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="btn btn-success m-1 m-1"
                                        aria-current="page" 
                                        href="/cisnatura/resources/views/newcita.php"
                                        style="transition: transform 0.3s;"
                                        onmouseover="this.style.transform = 'scale(1.1)';"
                                        onmouseout="this.style.transform = 'scale(1)';"
                                        >Crear Cita</a>
                            </li> -->

                            <?php if(!is_null($ua) && $ua->sv && $ua->tipo ==1){ ?>
                            <li class="nav-item">
                            <button class="btn btn-primary m-1"
                                    type="button" aria-current="page"
                                    onclick="app.view('newproduct')"
                                    style="transition: transform 0.3s;"
                                    onmouseover="this.style.transform = 'scale(1.1)';"
                                    onmouseout="this.style.transform = 'scale(1)';"
                            >Nuevo Producto</button>
                            </li>
                            <li class="nav-item">
                            <button class="btn btn-primary m-1"
                                    type="button" aria-current="page"
                                    onclick="app.view('miscitas')"
                                    style="transition: transform 0.3s;"
                                    onmouseover="this.style.transform = 'scale(1.1)';"
                                    onmouseout="this.style.transform = 'scale(1)';"
                            >
                            Mis Citas</button>
                            </li>
                            <?php } ?>
                        </ul>
                        <ul class="navbar-nav ml-auto mb-2 d-flex">

                            <?php if(is_null($ua) || !$ua->sv){ ?>

                            <li class="nav-item">
                                <button type="button" class="nav-link btn btn-link" 
                                    onclick="app.view('inisession')" >
                                    Iniciar Sesión
                                </button>
                            </li>
                            <?php } else { ?>                            
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?=$ua->name?>
                                </a>
                                <ul class="dropdown-menu w-50 mx-left">
                                    <li>
                                        <button type="button" class="dropdown-item btn btn-danger"
                                            onclick="app.view('endsession')">
                                            Cerrar sesión
                                        </button>
                                    </li>
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </div>
    <?php
}
function scripts($script=""){
?>
</div>
<script src="/cisnatura/resources/js/jquery.js"></script>
<script src="/cisnatura/resources/js/popper.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="/cisnatura/resources/js/bootstrap.js"></script>
<script src="/cisnatura/resources/js/app.js"></script>
<?php
    if($script != ''){
        echo '<script src="/cisnatura/resources/js/' . $script . '.js"></script>';
    }
}
    function foot(){
?>

    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Inicio</a></li>
                <li class="nav-item"><a href="/cisnatura/resources/views/catalogo.php" class="nav-link px-2 text-body-secondary">Catálogo</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Ubicación</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Aviso de privacidad</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Preguntas</a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><i class="bi bi-instagram"></i></svg></a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><i class="bi bi-facebook"></i></svg></a></li>
                <li class="ms-3"><a class="text-body-secondary" href="#"><svg class="bi" width="24" height="24"><i class="bi bi-whatsapp"></i></svg></a></li>
            </ul>
            <p class="text-center text-body-secondary">&copy; 2023 CISnatura, Inc</p>
        </footer>
    </div>
</body>
</html>


<?php }