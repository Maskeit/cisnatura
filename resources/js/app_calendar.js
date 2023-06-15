const app_calendar = {
  url: "/cisnatura/app/app.php",

  ad : $("#available-dates"),
  // Función para verificar la disponibilidad de horarios del día seleccionado
  verificarCita: function(fecha) {
    let html = `no hay horarios disponibles`
    this.ad.html("");
    fetch(this.url + "?_fecha=" + fecha)
      .then(resp => resp.json())
      .then(cavresp => {
        console.log(cavresp);
        if (cavresp.length > 0) {
          html = "";
          for (let dato of cavresp) {
            const horaNotAvailable = dato.hora_cita;
            console.log(horaNotAvailable); // Imprimir la hora de cada cita en la consola
            html += `
              <tr>
                <td></td>
              </tr>
            `;
          }
        }
      })
      .catch(err => console.error(err));
  },
};

function crearCalendario() {
  var availableDates = ['2023-06-15','2023-06-16','2023-06-17','2023-06-17', '2023-06-20', '2023-06-25'];
  var calendar = document.getElementById('calendar');

  calendar.innerHTML = '';

  for (var i = 1; i <= 30; i++) {
    var date = new Date();
    date.setDate(i);
    var dateString = date.toISOString().slice(0, 10);

    var day = document.createElement('div');
    day.className = 'day';
    day.textContent = i;

    if (availableDates.includes(dateString)) {
      day.classList.add('available');
      day.addEventListener('click', function() {
        var selectedDate = this.dataset.date;
        fechaInput.value = selectedDate;

        // Llamar a la función para verificar la disponibilidad de horarios
        app_calendar.verificarCita(selectedDate);
      });
    } else {
      day.classList.add('unavailable');
      day.style.pointerEvents = 'none';
    }

    day.dataset.date = dateString;
    calendar.appendChild(day);
  }
}

crearCalendario();

//Control del formuluario

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