<?php
namespace views;
require "../../../app/autoloader.php";
include "../layouts/main.php";
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

<section class="container pt-5"> 
    <h1 class="border-bottom rounded p-2 text-white bg-opacity-10" style="background-color: rgba(0, 0, 0, 0.6)">Mis Citas</h1> 
    <div class="card shadow">
        <div class="card-body">
           <table class="table table-striped">
           <thead>
                <tr>
                    <th>Fecha programada</th>
                    <th>Hora</th>
                    <th>Nombre del paciente</th>
                    <th>Tipo de Cita</th>
                    <th>Telefono</th>
                    <th><i class="bi bi-gear"></i></th>
                </tr>
            </thead>

            <tbody id="my-citas">

            </tbody>
           </table>
        </div>        
    </div>
    <tfoot>
        <tr>
            <td colspan="6">
                <div id="pagination" class="pagination"></div>
            </td>
        </tr>
    </tfoot>
</section>


<?php
    scripts("app_mycitas");
?>
<script>
    $(function(){
        app_mycitas.getMyCitas();
    });
</script>
<?php
    foot();