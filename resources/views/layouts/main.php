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

    <title>Cisnatura Citas</title>
</head>
<body>
    <div id="app" class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/cisnatura/resources/views/home.php">Cisnatura</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/cisnatura/resources/views/home.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cisnatura/resources/views/newcita.php">Crear Cita</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cisnatura/resources/views/miscitas.php">Citas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/cisnatura/resources/views/catalogo.php">Catálogo</a>
                </li>
                <?php if(is_null($ua) || !$ua->sv){ ?>

                <li class="nav-item">
                    <button type="button" class="nav-link btn btn-link" 
                        onclick="app.view('inisession')" >
                        Iniciar Sesión
                    </button>
                </li>

                <?php }  else {?>
                <li class="nav-item">
                    <button type="button" class="nav-link btn btn-link" 
                        onclick="app.view('endsession')" >
                        Cerrar Sesión
                    </button>
                </li>
                <?php } ?>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Más
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="#">Action</a></li>
                    <li><a class="dropdown-item" href="#">Another action</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
                </li>
            </ul>
            </div>
            <li class="nav-item">
                    <button type="button" class="nav-link btn btn-link">
                        <?=$ua->name?>
                    </button>
                </li>
            <span class="navbar-text mx-2"><i class="bi bi-basket"></i></span>
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