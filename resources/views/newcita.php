<?php
namespace views;
require "../../app/autoloader.php";
include "./layouts/main.php";
use Controllers\auth\LoginController as LoginController;
$ua = new LoginController;
head($ua);
?>
<style>
    #calendar {
    display: flex;
    flex-wrap: wrap;
    width: 300px;
    border: 1px solid #ccc;
    font-family: Arial, sans-serif;
    }

    .calendar-header {
    width: 100%;
    text-align: center;
    font-weight: bold;
    padding: 10px;
    background-color: #f5f5f5;
    }

    .calendar-row {
    width: 100%;
    display: flex;
    }

    .weekdays-row {
    width: 100%;
    font-weight: bold;
    border-bottom: 1px solid #ccc;
    }

    .calendar-cell {
    flex: 1;
    padding: 10px;
    text-align: center;
    }

    .weekday-cell {
    background-color: #f5f5f5;
    }

    .day-cell {
    cursor: pointer;
    }

    .current-day {
    background-color: #5cb85c;
    color: #fff;
    }

    .weekend {
    background-color: #d9534f;
    color: #fff;
    }

    .available-schedule {
    margin-top: 20px;
    padding: 10px;
    background-color: #f5f5f5;
    }
</style>


    <div class="row mx-auto mt-2" style="width: 90%;">
        <div class="alert alert-success" role="alert">
            Verifica la disponibilidad de tu cita en el calendario de seleccion
        </div>
    </div>
    
    <div class="row mx-auto mt-2" style="width: 90%;">
        <div class="col-7">
            <div id="cita-prev">
                <h1>Solicitar Cita</h1>

                <form id="cita-form" action="" method="POST">

                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#myModal">
                        Seleccionar Fecha y Hora<i class="bi bi-calendar-check mx-3"></i><i class="bi bi-smartwatch"></i>
                    </button>

                    <div class="row">
                        <div class="col">
                            <div class="form-control m-2">
                                <label for="fecha">Fecha:</label>
                                <input type="text" id="fecha" type="date" class="form-control" name="fecha_cita" required >
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-control m-2">
                                <label for="hora">Hora:</label>
                                <input type="text" id="hora" type="time" class="form-control" name="hora_cita" required >
                            </div>
                        </div>
                    </div>

                    <label for="cliente">Nombre:</label>
                    <input class="form-control m-2" type="text" id="cliente" name="nombre_cliente" placeholder="Ejem: <?=$ua->name?>" required>

                    <label for="tipo_cita">Tipo de Cita:</label>
                    <select class="form-select m-2" id="tipo_cita" aria-label="Example select with button addon">
                        <option selected>Consulta</option>
                        <option value="Curso">Curso</option>
                        <option value="Asesoria">Asesoria</option>
                    </select>

                    <label for="telefono">Teléfono:</label>
                    <input class="form-control m-2" type="text" id="telefono" name="telefono_cliente">

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Confirmar registro</button>
                    </div>
                </form>
                <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Seleccionar Fecha</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                            <div class="col-8">
                            <div id="calendar"></div>
                            </div>
                            <div class="col-4">
                            <div id="available-dates">
                                <h4>Horarios disponiles:</h4>
                            </div>
                            </div>
                        </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hecho</button>
                        </div>
                        </div>
                    </div>
                    </div>

            </div>
            
        </div>
                        
        <div id="cita-preview" class="col-5 mt-2">
                <h3>Registro de Cita:</h3>
                <div class="alert alert-warning" role="alert">
                    <p id="fecha-preview"></p>
                    <p id="hora-preview"></p>
                    <p id="cliente-preview"></p>
                    <p id="tipo-cita-preview"></p>
                    <p id="telefono-preview"></p>
                </div>
        </div>   
    </div>

    
    <?php scripts();?>
    
    
    <!-- calendar-generator control -->
    <script src="/cisnatura/resources/js/app_calendar.js"></script>

<!-- preview-cita control -->
<script>

</script>

<!-- form-control -->
<script type="text/javascript">
        $(function(){
            const cf = $("#cita-form"); //cf es cita form
            cf.on("submit", function(e){
                e.preventDefault();
                e.stopPropagation();
                const data = new FormData();
                data.append("fecha_cita",$("#fecha").val());
                data.append("hora_cita",$("#hora").val());   
                data.append("nombre_cliente",$("#cliente").val());
                data.append("tipo_cita",$("#tipo_cita").val());
                data.append("telefono_cliente",$("#telefono").val());
                data.append("_cita","");
                fetch(app.routes.citas,{
                    method : "POST",
                    body : data
                })
            .then ( resp => resp.json())
            .then ( resp => {
                if(resp.r !== false){
                    alert("la cita se ha registrado correctamente");
                    location.href = "/cisntatura/views/home.php";
                    //app.view("home");
                    data.reset();
                    alert('La cita se ha registrado correctamente');
                }else{
                    $("#error").removeClass("d-none");
                }
            }).catch( err => console.error( err ));
        })
    })
</script>

<?php
    foot();