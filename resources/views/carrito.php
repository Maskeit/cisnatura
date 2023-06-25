<?php
namespace views;
require "../../app/autoloader.php";
include "./layouts/main.php";
use Controllers\auth\LoginController as LoginController;
$ua = new LoginController;
$sessionData = $ua->sessionValidate();
if (!$sessionData) {
    // No se ha iniciado sesión, redirigir a la página de inicio de sesión
    header("Location: /cisnatura/resources/views/auth/login.php");
    exit;
}
head($ua);
?>
<section class="container pt-3">
    <div class="row">
        <div class="col-md-9">
            <div class="card shadow">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Img</th>
                                <th>Descripcion</th>
                                <th>cantidad</th>
                                <th>precio unitario</th>
                                <th>precio total</th>
                            </tr>
                        </thead>
        
                        <tbody id="pedido">
        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body">

                    <small>Listo para pagar</small>
                    <div id="pago"></div>
                    
                </div>
            </div>
        </div>
    </div>

</section>

<?php 
    scripts('app_car');
?>
<script>
$(function(){
    app_car.contentCar(<?=$ua->id?>);
})
</script>
<?php    
    foot();