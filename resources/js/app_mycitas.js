const app_mycitas ={
    url : "/cisnatura/app/app.php",

    mc : $("#my-citas"),

    getMyCitas : function(){
        let html = `<tr><td colspan="3">Aún no tiene citas</td></tr>`;      
        this.mc.html("");
        fetch(this.url + "?_mc")
            .then( resp => resp.json())
            .then( mcresp => {
                if(mcresp.length > 0){
                    html = "";
                    //console.log(mcresp);
                    for( let cita of mcresp){
                    const citaActive = cita.active;
                    const citaRealizada = cita.active === "1" ? "-fill" : "";
                    const fechaCita = new Date(cita.fecha_cita).toLocaleDateString('es-ES', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                      });
                    html+= `
                    <tr>
                     <td>${fechaCita}</td>
                         <td>${cita.hora_cita}</td>
                         <td>${cita.nombre_cliente}</td>
                         <td>${cita.tipo_cita}</td>
                         <td>${cita.telefono_cliente}</td>
                         <td>
                             <a href="#" class="link-success mx-2" onclick="app_mycitas.completarCita(${cita.id})" id="completeCita"><i class="bi bi-check-circle${citaRealizada}"></i></a>
                             <a href="#" class="link-primary mx-2" id="edCita" onclick=""><i class="bi bi-pencil-square"></i></a>
                             <a href="#" class="link-secondary mx-2"  onclick="app_mycitas.eliminarCita(${cita.id})" id="deleteCita"><i class="bi bi-trash"></i></a>
                         </td>
                     </tr>
                    `; 
                    }
                }
                this.mc.html(html);
            }).catch( err => console.error(err));            
    },

    completarCita : function(pid){
        fetch(this.url + "?_tcc&=" + pid)
        .then( resp => {
            if(resp.ok){
              alert("Se ha actualizado el estado de la cita a completado.");
              this.getMyCitas();
            }
        }).catch(err => console.error("Hay un error :",err));
    },

    eliminarCita: function(pid) {
        const confirmDelete = confirm("¿Estás seguro de cancelar la cita? Se eliminará el registro.");
        if (confirmDelete) {
            fetch(this.url + "?_dc=" + pid)
                .then(resp => resp.json())
                .then(data => {
                    if (data.r === "success") {
                        alert("Se ha eliminado la cita.");
                        this.getMyCitas(); // Actualizar la lista de citas después de eliminar
                    } else {
                        alert("No se pudo eliminar la cita.");
                    }
                })
                .catch(err => console.error(err));
        }
    }
    

}