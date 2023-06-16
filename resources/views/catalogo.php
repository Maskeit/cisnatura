<?php
namespace views;
require "../../app/autoloader.php";
include "./layouts/main.php";
use Controllers\auth\LoginController as LoginController;
$ua = new LoginController;
head($ua);
?>
<style>
    .card:hover {
        transform: scale(1.05);
    }
</style>

<div class="container">
    <div class="row justify-content-center mt-4 mb-3">
        <h2 class="wp-block-heading mt-5" style="text-decoration: none;">
            Cátalogo Cisnatura
        </h2>
        <div class="col-md-3 my-3 col-sm-8" id="product-card">
            <!-- aqui van los productos -->
            
        </div>
    </div>
</div>


<?php scripts();?>
<?php
    foot();