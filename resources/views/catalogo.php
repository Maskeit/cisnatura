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
    <h2 class="wp-block-heading mt-5" style="text-decoration: none;">
        Cátalogo Cisnatura
    </h2>
    <div id="aviso" >
    </div>
    <div class="row justify-content-center mt-4 mb-3">
        <?php if(!is_null($ua) && $ua->sv && $ua->tipo ==1){ ?>
        <div id="product-card-edit" class="content">
            <h3>Solo <?=$ua->name?>  puede ver esto y editarlo</h3>
            <!-- aqui van los productos que se pueden editar -->
        </div>
                <!-- Modal para editar producto -->
        <div class="modal fade" id="productModalEdit" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="productModalLabel">Edita los Detalles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="productModalBodyEdit">
                        <!-- Aquí se mostrarán los datos del producto -->
                    </div>
                </div>
            </div>
        </div>
        <?php } else { ?>
        <div class="col-3">
            <div id="filter-products" class="lis-group">
                <!-- clasificacion de productos -->

            </div>
        </div>        
        <div class="col-9">
            <div id="product-card" class="content">
                <!-- aqui van los productos -->
            </div>
        </div>
        <!-- Modal -->
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
        <!--delete Modal-->
                <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body" id="deleteProductModalBody">
                        <!-- Aquí se mostrarán los datos del producto -->
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</div>


<?php scripts();?>
<script type="text/javascript">
    $(function(){
        app.user.sv = <?=$ua->sv?'true':'false'?>;
        app.user.id = "<?=$ua->id?>";
        app.user.tipo = "<?=$ua->tipo?>";
        if(app.user.tipo == 1){
            app.productEdit();
        }else{
            app.productView();
            app.filterProducts();
        }
    })

</script>
<?php
    foot();