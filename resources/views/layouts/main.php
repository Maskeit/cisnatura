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

    <title>Cisnatura Citas</title>
</head>
<body>
    <div id="app" class="container-fluid p-0">
        <header class="row m-0 bg-dark " data-bs-theme="dark">
            <div class="col-9">
                <h1 class="ml-3 mt-2">Tienda CISnatura</h1>
            </div>
            <div class="col-3 mt-2">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" id="buscar-palabra" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-outline-success" onclick="app.buscarPalabra()" type="button"><i class="bi bi-search"></i></button>
                </form>
            </div>
        </header>
        <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary bg-white bg-gradient mb-4" data-bs-theme="light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="btn btn-success m-1 m-1"
                                aria-current="page" 
                                href="/cisnatura/resources/views/home.php"
                                style="transition: transform 0.3s;"
                                onmouseover="this.style.transform = 'scale(1.1)';"
                                onmouseout="this.style.transform = 'scale(1)';"
                                >Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success m-1 m-1"
                                aria-current="page" 
                                href="/cisnatura/resources/views/catalogo.php"
                                style="transition: transform 0.3s;"
                                onmouseover="this.style.transform = 'scale(1.1)';"
                                onmouseout="this.style.transform = 'scale(1)';"
                                >Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success m-1 m-1"
                                aria-current="page" 
                                href="/cisnatura/resources/views/newcita.php"
                                style="transition: transform 0.3s;"
                                onmouseover="this.style.transform = 'scale(1.1)';"
                                onmouseout="this.style.transform = 'scale(1)';"
                                >Crear Cita</a>
                    </li>

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
                 <ul   class="navbar-nav ml-auto mb-2 d-flex">

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

</body>
</html>
<!-- <footer class="bg-dark text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-5 mt-5">
                <img src="/cisnatura/resources/img/plantas1.jpg" alt="Logo" class="rounded" style="width: 100px;">
            </div>
            <div class="col-md-4 mb-5 mt-5">
                <p>&copy; CISnatura</p>
            </div>
            <div class="col-md-4 mb-5 mt-5">
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#">Aviso de privacidad</a></li>
                    <li class="list-inline-item"><a href="#">Facebook</a></li>
                    <li class="list-inline-item"><a href="#">Instagram</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer> -->

<?php }