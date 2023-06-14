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
    
}

