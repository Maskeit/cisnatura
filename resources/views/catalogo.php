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
        <div class="col-md-3 my-3 col-sm-8">
            <div class="card" style="width: 18rem; transition: transform 0.3s;">
                <img src="/cisnatura/resources/img/back.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Nuestras tinturas...</p>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-success">COMPRAR</button>
                        <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3 col-sm-8">
            <div class="card" style="width: 18rem; transition: transform 0.3s;">
                <img src="/cisnatura/resources/img/plantas1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Nuestras tinturas...</p>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-success">COMPRAR</button>
                        <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3 col-sm-8">
            <div class="card" style="width: 18rem; transition: transform 0.3s;">
                <img src="/cisnatura/resources/img/back.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Nuestras tinturas...</p>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-success">COMPRAR</button>
                        <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3 col-sm-8">
            <div class="card" style="width: 18rem; transition: transform 0.3s;">
                <img src="/cisnatura/resources/img/plantas1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Nuestras tinturas...</p>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-success">COMPRAR</button>
                        <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3 col-sm-8">
            <div class="card" style="width: 18rem; transition: transform 0.3s;">
                <img src="/cisnatura/resources/img/back.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Nuestras tinturas...</p>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-success">COMPRAR</button>
                        <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3 col-sm-8">
            <div class="card" style="width: 18rem; transition: transform 0.3s;">
                <img src="/cisnatura/resources/img/plantas1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Nuestras tinturas...</p>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-success">COMPRAR</button>
                        <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3 col-sm-8">
            <div class="card" style="width: 18rem; transition: transform 0.3s;">
                <img src="/cisnatura/resources/img/back.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Nuestras tinturas...</p>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-success">COMPRAR</button>
                        <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3 col-sm-8">
            <div class="card" style="width: 18rem; transition: transform 0.3s;">
                <img src="/cisnatura/resources/img/plantas1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Nuestras tinturas...</p>
                    <div class="d-flex justify-content-between mt-4">
                        <button type="button" class="btn btn-success">COMPRAR</button>
                        <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php scripts();?>
<?php
    foot();