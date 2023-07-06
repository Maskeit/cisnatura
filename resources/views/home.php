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

<main>
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light" style="background-image: url('/cisnatura/resources/img/verde2.jpg'); background-size:cover">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal">Tienda CISnatura</h1>
            <p class="lead fw-normal rounded-3 text-white bg-opacity-3" style="background-color: rgba(0, 0, 0, 0.4)">Bienvenido(a) a la tienda CISnatura, Fabrica de remedios herbolarios</p>
            <a class="btn btn-outline-secondary" href="/cisnatura/resources/views/catalogo.php">Ver productos</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
</main>
<div class="container">
    <div class="row justify-content-center mt-4 mb-3">
        <div class="col-md-6 text-center align-items-center">
            <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="var(--bs-secondary-color)"/></svg>
            <h2 class="fw-normal">Heading</h2>
            <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
            <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
        </div>
        <div class="col-md-6 rounded-3">
            <p class="fw-lighter">
            En nuestra fábrica, nos enorgullece ofrecer productos elaborados con ingredientes naturales de la más alta calidad. Nos especializamos en la creación de tinturas a base de plantas naturales, así como en la producción de una amplia variedad de productos naturistas que promueven la salud y el bienestar.
Nuestro compromiso con la naturaleza es fundamental en cada etapa de nuestro proceso de fabricación. Utilizamos exclusivamente plantas naturales cuidadosamente seleccionadas, así como ingredientes puros como la sal de mar y el agua de mar, para garantizar la máxima eficacia y beneficios para nuestros clientes.
Nos apasiona ofrecer alternativas naturales y respetuosas con el medio ambiente para el cuidado de la salud. Nuestros productos se elaboran con amor y dedicación, combinando conocimientos ancestrales con métodos de producción modernos para brindar soluciones naturales efectivas.
            </p>
        </div>
    </div>

    <div class="row justify-content-center mt-4 mb-3">
        <h2 class="wp-block-heading mt-5" style="text-decoration: none;">
            <a href="catalogo.php" data-type="#" data-id="#" target="_blank" rel="#" style="color: #6c757d; text-decoration: none;">Cisnatura Productos <i class="bi bi-box-arrow-in-up-right"></i></a>
        </h2>

        <div id="product-tintura" class="content">
            <!-- aqui va un solo representante del producto -->

        </div>
    </div>

    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="col-md-5 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-normal">Aprende mas</h1>
            <p class="lead fw-normal">Visita cisnatura.com y mantente informado acerca de los mejores remedios herbolarios.</p>
            <a class="btn btn-outline-secondary" href="https://www.cisnatura.com/">Ver pagina principal</a>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
            <!-- Modal del producto -->
            <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Detalles del Producto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="productModalBody">
                        <!-- Aquí se mostrarán los datos del producto -->
                    </div>
                </div>
            </div>
            </div>
</div>



<?php scripts();?>
<script type="text/javascript">
    $(function(){
        app.user.sv = <?=$ua->sv?'true':'false'?>;
        app.lastPostTintura(4);
    })
</script>

<?php
    foot();