<?php
    function head(){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/cisnatura/resources/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>Cisnatura Dashboard</title>
</head>
<body>
    <div id="app" class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Cisnatura Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Crear Cita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="miscitas.php">Otra Página</a>
                    </li>
                </ul>
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
<?php }