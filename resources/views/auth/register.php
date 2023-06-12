<?php

    namespace views;
    require "../../../app/autoloader.php";
    include "../layouts/main.php";
    use Controllers\auth\LoginController as LoginController;

    head();

?>
<div class="container">
    <div class="card mt-5 w-50 mx-auto">
        <div class="card-body">
            <form action="" id="register-form">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" 
                            id="name"
                            class="form-control"
                            name="name"
                            placeholder="Nombre completo"
                            required>   
                </div>
                <div class="form-group">
                    <label for="email">Correo electronico</label>
                    <input type="email" 
                            id="email"
                            class="form-control"
                            name="email"
                            placeholder="example@blog.com"
                            required>
                </div>
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <input type="text" 
                            id="username"
                            class="form-control"
                            name="username"
                            placeholder="Nombre de usuario"
                            required>   
                </div>
                <div class="form-group">
                    <label for="passwd">Contraseña</label>
                    <input type="password" 
                            class="form-control" 
                            id="passwd"
                            name="passwd"
                            required>
                </div>
                <div class="form-group">
                    <label for="passwd2">Repetir Contraseña</label>
                    <input type="password" 
                            class="form-control" 
                            id="passwd2"
                            name="passwd2"
                            required>
                </div>
                <div class="d-grid gap-2 my-2">
                    <small class="form-text text-danger d-none" id="error">
                        Sus datos de registro son incorrecctos
                    </small>
                    <button class="btn btn-primary" type="submit">
                        Registrar <i class="bi bi-box-arrow-in-right"></i>
                    </button>
                    <button class="btn btn-link floant-end" type="button" onclick="app.view('inisession');">
                        ¿Ya tienes una cuenta? Inicia aquí
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php scripts(); ?>

<script type="text/javascript">
    $(function(){
        const rf = $("#register-form");
        rf.on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();
            const data = new FormData();
            data.append("name", $("#name").val());
            data.append("email", $("#email").val());
            data.append("username",$("#username").val());
            data.append("passwd",$("#passwd").val());
            if($("passwd").val() === $("passwd2").val()){
                data.append("_register","");
                fetch(app.routes.doregister,{
                    method : "POST",
                    body : data
                })
                    .then ( resp => resp.json())
                    .then ( resp => {
                        if(resp.r !== false){
                            //location.href = "/ProgramacionPPW/blog/resources/views/home.php";
                            app.view("inisession");
                        }else{
                            $("#error").removeClass("d-none");
                        }
                    }).catch( err => console.error( err ));
            }else{
                alert("las contrasenas deben ser iguales");
            }
        })
    })
</script>