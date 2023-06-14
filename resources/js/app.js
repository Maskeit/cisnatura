const ruta = "/cisnatura";
const app = {
    routes : {
        home : ruta + "/resources/views/home.php",
        inisession : ruta + "/resources/views/auth/login.php",
        register : ruta + "/resources/views/auth/register.php",
        doregister : ruta + "/app/app.php",
        
        endsession :ruta + "/app/app.php?_logout",
        login : ruta +"/app/app.php",


        citas : ruta +"/app/app.php",
        lastcita : ruta +"/app/app.php?_lc",
    },

    lc : $("#ultima-cita"),

    view : function(route){
        location.replace(this.routes[route]);
    },

    lastCita: function(limit) {
        let html = "<h3>Aun no hay citas</h3>";
        this.lc.html("");
        fetch(this.routes.lastcita + "&limit=" + limit)
            .then(response => response.json())
            .then(lcresp => {
                console.log(response); // Agrega esta línea para ver los elementos recibidos
                if (lcresp.length > 0) {
                    html = `
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">${lcresp[0].fecha_cita}</h5>
                            <p class="card-text">${lcresp[0].hora_cita}</p>
                            <p class="card-text">${lcresp[0].nombre_cliente}</p>
                        </div>
                    </div>`;
                }
                this.lc.html(html);
            }).catch(err => console.log(err));
    }
    
}

