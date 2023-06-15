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
        <div class="col-md-6">
            <div class="card" style="width: 28rem;">
                <img src="/cisnatura/resources/img/plantas1.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <p class="card-text">Nuestras tinturas herbolarias están diseñadas con ingredientes de alta calidad.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6 rounded-3" style="background-color: #f8f9fa;">
            <p class="fw-lighter">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
        </div>
    </div>

    <div class="row justify-content-center mt-4 mb-3">
        <h2 class="wp-block-heading mt-5" style="text-decoration: none;">
            <a href="catalogo.php" data-type="#" data-id="#" target="_blank" rel="#" style="color: #6c757d; text-decoration: none;">Cisnatura Productos</a>
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
    </div>
</div>



<?php scripts();?>


<?php
    foot();