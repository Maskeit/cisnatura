const app_calendar = {
    url : "/cisnatura/app/app.php",

    verificarCita : function(ctime){
        fetch(this.url + "?_available&="+ctime)
        .then(resp => resp.json())
        .then( cavresp => {
            if(cavresp.length > 0){
                for( let cita of cavresp){
                    let horario = cita.hora_cita;
                    let fecha = cita.fecha_cita;
                }
            }
        }).catch( err => console.error(err)); 
    },
};


function crearCalendario() {
    var calendar = document.getElementById('calendar');
    calendar.innerHTML = '';
  
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    var currentMonth = currentDate.getMonth();
  
    var monthNames = [
      'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
      'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
    ];
  
    var daysOfWeek = ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'];
  
    // Crear el encabezado del calendario con el mes y año actual
    var header = document.createElement('div');
    header.className = 'calendar-header';
    header.textContent = monthNames[currentMonth] + ' ' + currentYear;
    calendar.appendChild(header);
  
    // Crear los nombres de los días de la semana
    var weekdaysRow = document.createElement('div');
    weekdaysRow.className = 'calendar-row weekdays-row';
    for (var i = 0; i < 7; i++) {
      var weekdayCell = document.createElement('div');
      weekdayCell.className = 'calendar-cell weekday-cell';
      weekdayCell.textContent = daysOfWeek[i];
      weekdaysRow.appendChild(weekdayCell);
    }
    calendar.appendChild(weekdaysRow);
  
    // Calcular el primer y último día del mes actual
    var firstDayOfMonth = new Date(currentYear, currentMonth, 1);
    var lastDayOfMonth = new Date(currentYear, currentMonth + 1, 0);
  
    // Calcular el número de días en el mes actual
    var daysInMonth = lastDayOfMonth.getDate();
  
    // Calcular el índice del día de la semana en que empieza el mes (0: Domingo, 1: Lunes, ...)
    var startIndex = firstDayOfMonth.getDay();
  
    // Crear los días del mes
    var currentRow = document.createElement('div');
    currentRow.className = 'calendar-row';
  
    for (var i = 0; i < startIndex; i++) {
      var emptyCell = document.createElement('div');
      emptyCell.className = 'calendar-cell empty-cell';
      currentRow.appendChild(emptyCell);
    }
  
    for (var i = 1; i <= daysInMonth; i++) {
      var dayCell = document.createElement('div');
      dayCell.className = 'calendar-cell day-cell';
      dayCell.textContent = i;
  
      if (i === currentDate.getDate() && currentMonth === currentDate.getMonth()) {
        dayCell.classList.add('current-day');
      }
  
      if (currentMonth === 5 || currentMonth === 6) {
        dayCell.classList.add('weekend');
      }
  
      currentRow.appendChild(dayCell);
  
      if ((i + startIndex) % 7 === 0) {
        calendar.appendChild(currentRow);
        currentRow = document.createElement('div');
        currentRow.className = 'calendar-row';
      }
    }
  
    if (currentRow.children.length > 0) {
      calendar.appendChild(currentRow);
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