const ruta = "/cisnatura";
const rutapp = "/cisnatura/app/app.php";
const app = {
    routes : {
        home : ruta + "/resources/views/home.php",
        inisession : ruta + "/resources/views/auth/login.php",
        register : ruta + "/resources/views/auth/register.php",
        doregister : ruta + "/app/app.php",
        carrito : ruta + "/resources/views/carrito.php",
        
        endsession :ruta + "/app/app.php?_logout",
        login : ruta +"/app/app.php",

        miscitas : ruta +"/resources/views/admin/miscitas.php",
        newproduct : ruta +"/resources/views/admin/newproduct.php",

        prevproducts : ruta + "/app/app.php?_tp",
        singleproduct : ruta + "/app/app.php",
        //botones de compra y add
        addproduct : rutapp+"?_ap",
        vercant: rutapp,

        allproducts : ruta +"/app/app.php?_tpe", //trae los productos a editar
        updateproduct : ruta +"/app/app.php",
        deleteproduct : ruta+"/app/app.php",
        togglepost : ruta+"/app/app.php",
        //rutas de funciones del home
        lastpostT : ruta + "/app/app.php?_lp",
        typeprod : ruta + "/app/app.php?_tof",
    },
    view : function(route){
        location.replace(this.routes[route]);
    },
    user : {
        sv : false,
        id : "",
        tipo : "",
    },

    ad:$('#aviso'),
    fp : $('#filter-products'),
    ap : $('#addproduct'), //cantidad de prodcutos en el carrito
    pc: $('#product-card'),
    pce: $('#product-card-edit'),
    lpt : $('#product-tintura'),
    padd : $('#toastContainer'),
    currentType : "",

    //Filtro de productos
    listProducts: function(toggle){
        let html = `<h4>Filter Product disabled</h4>`;
        let primera = true;
        //console.log(toggle);
        const tta = toggle === 'tintura' ? " active" : "";
        const tcds = toggle === 'cds' ? " active" : "";
        const tcrs = toggle === 'curso' ? " active" : "";
        const totr = toggle === 'otro' ? " active" : "";
        this.fp.html("");
        html= `
        <ul class="list-group">
            <li class="list-group-item list-group-item-action ${tta}" onclick="app.productView('tintura', event)">Tinturas</li>
            <li class="list-group-item list-group-item-action ${tcds}" onclick="app.productView('cds', event)">Dioxido de cloro</li>
            <li class="list-group-item list-group-item-action ${tcrs}" onclick="app.productView('curso', event)">Cursos</li>
            <li class="list-group-item list-group-item-action ${totr}" onclick="app.productView('otro', event)">Otros Productos</li>            
        </ul>
        `;
        this.fp.html(html);
    },
    //Todos los productos
    productView: function(tipo="tintura",event){
        //console.log(tipo);
        //event.preventDefault();
        this.ad.html("");
        let advice =`
        <div class="alert alert-warning" role="alert">
            Inicia sesion para que puedas comprar y agregar productos
        </div>
        `;
        if(this.user.sv == false){
            this.ad.html(advice);
        }
        let html = `<h2>No hay productos disponibles todavía</h2>`;
        this.pc.html("");
        fetch(this.routes.prevproducts)
        .then(resp => resp.json())
        .then(presp => {
            const products = JSON.parse(presp); // Convertir la cadena JSON a objeto JavaScript
            if (products.length > 0) {
                html = `<div class="row">`;
                let counter = 0;
                for (let product of products) {
                    if(product.type === tipo && product.active === "1"){
                        if (counter % 4 === 0 && counter !== 0) {
                            html += `</div><div class="row">`; // Cierra y abre una nueva fila después de cada grupo de 4 elementos
                        }
                        html += `
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3"> <!-- Se ajusta el número de columnas según el tamaño de pantalla -->
                            <div class="card" style="width: 14rem; transition: transform 0.3s;">
                                <img src="/cisnatura/app/pimg/${product.thumb}" class="card-img-top" alt="..." onclick="app.singleProduct(${product.id})">
                                <div class="card-body">
                                    <div class="row">                                        
                                            <h5>${product.product_name}</h5>                                        
                                        <div class="col">
                                        <span><i class="bi bi-currency-dollar">${product.price}</i></span>
                                        </div>
                                    </div>
                                    <p class="card-text">${product.extracto}</p>
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-success" ${this.user.sv ? '' : ' disabled'}  onclick="app.comprarProducto(${product.id})">COMPRAR</button>
                                        <button type="button"  
                                            class="btn btn-link link-success"${this.user.sv ? '' : ' disabled'} 
                                            onclick="app.agregarProducto(${product.id}, ${this.user.id},1)"><i class="bi bi-bag-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        counter++;
                    }
                }
                html += `</div>`;
                this.pc.html(html);
            }
        }).catch(err => console.error(err));
        app.listProducts(this.currentType = tipo);
    },

    singleProduct : function(pid){//pid es el product id
        fetch(this.routes.singleproduct+ "?_vp&pid="+ pid)
            .then(resp => resp.json())
            .then(presp => {
                const product = JSON.parse(presp);
                let html=`
                    <h5>${product[0].product_name}</h5>
                    <img src="/cisnatura/app/pimg/${product[0].thumb}" class="card-img-top" alt="...">
                    <p>${product[0].description}</p>
                    <h6>${product[0].price}<i class="bi bi-currency-dollar"></i></h6>
                `;
                document.getElementById("productModalBody").innerHTML = html;
                $("#productModal").modal("show"); // Muestra el modal
            }).catch(err => console.error(err))
    },
    
    //De lado de la administracion
    productEdit: function(){
        let html = `<h2>No hay productos disponibles todavía</h2>`;
        this.pce.html("");
        fetch(this.routes.allproducts)
        .then(resp => resp.json())
        .then(presp => {
            const products = JSON.parse(presp); // Convertir la cadena JSON a objeto JavaScript
            if (products.length > 0) {
                html = `<div class="row">`;
                let counter = 0;
                for (let product of products) {
                    if (counter % 4 === 0 && counter !== 0) {
                        html += `</div><div class="row">`; // Cierra y abre una nueva fila después de cada grupo de 4 elementos
                    }
                    html += `
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3"> <!-- Se ajusta el número de columnas según el tamaño de pantalla -->
                        <div class="card" style="width: 18rem; transition: transform 0.3s;" 
                        onclick="app.editSingleProduct(${product.id})">
                            <img src="/cisnatura/app/pimg/${product.thumb}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h5>${product.product_name}</h5>
                                    </div>
                                    <div class="col">
                                        <h6>${product.price}<i class="bi bi-currency-dollar"></i></h6>
                                    </div>
                                </div>
                                <p class="card-text">${product.extracto}</p>
                            </div>
                        </div>
                    </div>
                    `;
                    counter++;
                }
                html += `</div>`;
                this.pce.html(html);
            }
        })
        .catch(err => console.error(err));
    },
    editSingleProduct: function(pid){
        const productID = pid;
        //console.log(productID);
        fetch(this.routes.singleproduct+ "?_vp&pid="+ pid)
        .then(resp => resp.json())
        .then(presp => {
            const product = JSON.parse(presp);
            const toggleAc = product[0].active === "1" ? "on" : "off";
            //console.log(product[0].thumb)
            let html=`
            <form action="${rutapp}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="_ep" value="true">
                    <label>Tipo de producto</label>
                    <select class="form-select" name="type" aria-label="Default select example" required>
                        <option selected disabled>${product[0].type}</option>
                        <option value="tintura">Tintura</option>
                        <option value="cds">Dioxido De Cloro</option>
                        <option value="curso">Curso/taller</option>
                        <option value="otro">Otro</option>
                    </select>
                    <div class="mb-3 mt-2">
                        <label for="product_name" class="form-label">Nombre del Producto</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" value="${product[0].product_name}" required>
                    </div>
                    <div class="mb-3 mt-2">
                        <label for="extracto" class="form-label">Pequeña Descripcion del producto</label>
                        <input type="text" name="extracto" id="extracto" class="form-control" value="${product[0].extracto}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción completa del Producto</label>
                        <textarea name="description" id="description" class="form-control" cols="10" rows="5" value="${product[0].description}"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="thumb" class="form-label">Sube una imagen para mostrar tu producto</label>
                        <input class="form-control" name="thumb" type="file" id="thumb" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio del producto</label>
                        <input type="text" name="price" class="form-control" value="${product[0].price}" aria-label="price" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-secondary" type="button" onclick="app.deleteProduct(${product[0].id})">Eliminar producto <i class="bi bi-trash"></i> </button>
                    <button class="btn btn-primary" type="submit">Guardar<i class="bi bi-download"></i></button>
                    <a href="#" class="btn btn-link active" 
                    onclick="app.toggleProductActive(${product[0].id})"
                    ><i class="bi bi-toggle-${toggleAc}"></i>
                    </a>
                
                </div>

        </form>
            
            `;
            document.getElementById("productModalBodyEdit").innerHTML = html;
            $("#productModalEdit").modal("show"); // Muestra el modal
        }).catch(err => console.error(err))
    
        $("#productModalEdit").modal("hide");
    },
    deleteProduct : function(productID){
        const confirmado = confirm("Desea eliminar este producto?");
        if(confirmado){
            fetch(this.routes.deleteproduct + "?_dp=" + productID)
                .then(resp => resp.json())
                .then(data =>{
                    if (data.r === "success") {
                        this.productEdit(); // Actualizar la lista de citas después de eliminar
                    } else {
                        alert("No se pudo borrar");
                    }
                }).catch(err => console.error(err));
            $("#productModalEdit").modal("hide");            
        }
    },
    toggleProductActive : function(productID){
        fetch(this.routes.togglepost + "?_tac="+productID)
        .then( resp =>{
            if(resp.ok){
                alert("Se ha actualizado el estado del producto");
                this.productEdit();
                $("#productModalEdit").modal("hide");
            }
        }).catch( err => console.error(err));
    },
    
    //funciones del main
    lastPostTintura: function(limit) {
        let html = "<h4>Aún no hay productos</h4>";
        this.lpt.html("");      
        fetch(this.routes.lastpostT + "&limit=" + limit)
          .then(response => response.json())
          .then(lpresp => {
            const products = JSON.parse(lpresp);
            if (products.length > 0) {//&& products[0].type === 'tintura'
              html = `<div class="row">`;
                let counter = 0;
                for (let product of products) {
                    if(product.active === "1"){

                        if (counter % 4 === 0 && counter !== 0) {
                            html += `</div><div class="row">`; // Cierra y abre una nueva fila después de cada grupo de 4 elementos
                        }
                        html += `
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3"> <!-- Se ajusta el número de columnas según el tamaño de pantalla -->
                            <div class="card" style="width: 18rem; transition: transform 0.3s;">
                                <img src="/cisnatura/app/pimg/${product.thumb}" class="card-img-top" alt="..." onclick="app.singleProduct(${product.id})">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-9">
                                            <h5>${product.product_name}</h5>
                                        </div>
                                        <div class="col">
                                            <h6><i class="bi bi-currency-dollar"></i> ${product.price}</h6>
                                        </div>
                                    </div>
                                    <p class="card-text">${product.extracto}</p>
                                    <div class="d-flex justify-content-between mt-4">
                                        <button type="button" class="btn btn-success" ${this.user.sv ? '' : ' disabled'}  onclick="app.comprarProducto(${product.id})">COMPRAR</button>
                                        <button type="button"  class="btn btn-link link-success"${this.user.sv ? '' : ' disabled'} onclick="app.agregarProducto(${product.id})"><i class="bi bi-bag-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                        counter++;
                    }
                }
            }
            this.lpt.html(html);            
          })
          .catch(err => console.error(err));
    },
    //Comprar
    comprarProducto(pid){
        alert("Redirigiendo a pagar..");
    },

    //metodo para agregar un producto al carrito
    agregarProducto(pid, uid, tt) {
        this.padd.html("");
        fetch(this.routes.addproduct + "&pid=" + pid + "&uid=" + uid + "&tt=" + tt)
            .then(resp => resp.json())
            .then(data => {
                console.log(data);
                if (data.r === 'success') {
                    let html = $('<div>').addClass('toast')
                        .attr('role', 'alert')
                        .attr('aria-live', 'assertive')
                        .attr('aria-atomic', 'true')
                        .attr('data-bs-autohide', 'false')
                        .html(`
                            <div class="toast-header">
                                <img src="..." class="rounded me-2" alt="...">
                                <strong class="me-auto">CISnatura</strong>
                                <small>11 mins ago</small>
                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                            <div class="toast-body">
                                Se agregó 1 al carrito!
                            </div>
                        `);
                    this.padd.html(html);
                    this.verCant(uid);
                }
            })
            .catch(error => console.error(error));
    },
    
    
    //cantidad de prod en carrito
    verCant(uid){
    //const uid = this.user.id;
    let html = "";
    this.ap.html("");
    fetch(this.routes.vercant + "?_np=" + uid)
        .then(response => response.text())
        .then(data => {
            const cantidad = JSON.parse(data);
            const num = cantidad[0].tt === "0" ? "" : cantidad[0].tt;
            //console.log(cantidad);
                html = `<span class="badge bg-danger">${num}</span>`;
            this.ap.html(html);
            // Resto del código
        }).catch(error => console.error(error));
    },          
}

