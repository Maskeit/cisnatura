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

        miscitas : ruta +"/resources/views/admin/miscitas.php",
        newproduct : ruta +"/resources/views/admin/newproduct.php",

        prevproducts : ruta + "/app/app.php?_tp",
    },
    view : function(route){
        location.replace(this.routes[route]);
    },
    user : {
        sv : false,
        id : "",
        tipo : "",
    },

    pc : $('#product-card'),

    productView : function(){
        let html = `<h2>No hay productos disponibles todavia</h2>`
        this.pc.html("");
        fetch(this.routes.prevproducts)
        .then(resp => resp.json())
        .then( presp => {
            console.log(presp);
            if(presp.length > 0){
                html="";
                for( let product of presp){
                    html += `
                    <div class="card" style="width: 18rem; transition: transform 0.3s;">
            
                        <img src="" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5>${product.product_name}</5>
                            <p class="card-text">${product.description}</p>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-success">COMPRAR</button>
                                <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                            </div>
                        </div>
        
                    </div>
                    `;
                }
                this.pc.html(html);
            }

        }).catch( err => console.error(err));
    },
    
}

