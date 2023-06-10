<?php
namespace views;
require "../../app/autoloader.php";
include "./layouts/main.php";
head();
?>


    <div class="row mx-auto mt-2" style="width: 90%;">
        <div class="col-7">
            <div id="cita-prev">
                <h1>Crear Cita</h1>

                <form id="cita-form" action="guardar_cita.php" method="POST">
                    <label for="fecha">Fecha:</label>
                    <input class="form-control m-2" type="date" id="fecha" name="fecha_cita" required>

                    <label for="hora">Hora:</label>
                    <input class="form-control m-2" type="time" id="hora" name="hora_cita" required>

                    <label for="cliente">Cliente:</label>
                    <input class="form-control m-2" type="text" id="cliente" name="nombre_cliente" required>

                    <label for="tipo_cita">Tipo de Cita:</label>
                    <input class="form-control m-2" type="text" id="tipo_cita" name="tipo_cita" required>

                    <label for="telefono">Teléfono:</label>
                    <input class="form-control m-2" type="text" id="telefono" name="telefono_cliente">

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Confirmar registro</button>
                    </div>
                </form>

            </div>
        </div>
                
        <div id="cita-preview" class="col-5 mt-2">
                <h3>Registro de Cita:</h3>
                <div class="border-radius" style="background-color: rgba(100, 255, 110, 0.6); padding: 10px; border-radius: 10px;">
                    <p id="fecha-preview"></p>
                    <p id="hora-preview"></p>
                    <p id="cliente-preview"></p>
                    <p id="tipo-cita-preview"></p>
                    <p id="telefono-preview"></p>
                </div>

                <div id="ultima-cita" class="mt-7" style="background-color: rgba(100, 255, 110, 0.6); padding: 10px; border-radius: 10px;">
                    <!-- Aqui va colocada la ultima cita -->
                </div>
        </div>
    </div>
    
    <script>
        /**Datos del formulario */
    // Capturar los elementos del formulario
    const form = document.getElementById('cita-form');
    const fechaInput = document.getElementById('fecha');
    const horaInput = document.getElementById('hora');
    const clienteInput = document.getElementById('cliente');
    const tipoCitaInput = document.getElementById('tipo_cita');
    const telefonoInput = document.getElementById('telefono');

    // Capturar los elementos de vista previa
    const fechaPreview = document.getElementById('fecha-preview');
    const horaPreview = document.getElementById('hora-preview');
    const clientePreview = document.getElementById('cliente-preview');
    const tipoCitaPreview = document.getElementById('tipo-cita-preview');
    const telefonoPreview = document.getElementById('telefono-preview');

    // Actualizar la vista previa al cambiar los valores en el formulario
    fechaInput.addEventListener('input', () => {
        fechaPreview.textContent = `Fecha: ${fechaInput.value}`;
    });

    horaInput.addEventListener('input', () => {
        horaPreview.textContent = `Hora: ${horaInput.value}`;
    });

    clienteInput.addEventListener('input', () => {
        clientePreview.textContent = `Cliente: ${clienteInput.value}`;
    });

    tipoCitaInput.addEventListener('input', () => {
        tipoCitaPreview.textContent = `Tipo de Cita: ${tipoCitaInput.value}`;
    });

    telefonoInput.addEventListener('input', () => {
        telefonoPreview.textContent = `Teléfono: ${telefonoInput.value}`;
    });
    </script>
<?php scripts();?>
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
                    form.reset();
                    location.href = "/cisntatura/views/home.php";
                    //app.view("home");
                    form.reset();
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