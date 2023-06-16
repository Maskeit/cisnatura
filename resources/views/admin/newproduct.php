<?php
namespace views;
require "../../../app/autoloader.php";
include "../layouts/main.php";
use Controllers\auth\LoginController as LoginController;
$ua = new LoginController;
is_null($ua->sessionValidate()) ? header('Location: /resources/views/auth/login.php') : '';
head($ua);
?>
<section class="container pt-2">
    <div class="row justify-content-center mt-4 mb-3">
        <h3>Sube tu Producto</h3>
        <form action="../../../app/app.php" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" name="uid" value="<?=$ua->id?>">
                    <input type="hidden" name="_gp" value="true">
                    <select class="form-select" name="type" aria-label="Default select example" required>
                        <option selected disabled>Selecciona un tipo de producto</option>
                        <option value="tintura">Tintura</option>
                        <option value="cds">Dioxido De Cloro</option>
                        <option value="otro">Otro</option>
                    </select>
                    <div class="mb-3 mt-2">
                        <label for="product_name" class="form-label">Nombre del Producto</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Ejemplo: Tintura" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción del Producto</label>
                        <textarea name="description" id="description" class="form-control" cols="20" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="thumb" class="form-label">Sube una imagen para mostrar tu producto</label>
                        <input class="form-control" name="thumb" type="file" id="thumb" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio del producto</label>
                        <input type="text" name="price" class="form-control" placeholder="$" aria-label="price" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary" type="submit">Guardar<i class="bi bi-download"></i></button>
                </div>
            </div>
        </form>


    </div>
</section>
<?php 
    scripts();
    foot();