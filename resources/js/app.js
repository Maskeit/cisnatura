const ruta = "/cisnatura";
const app = {
    routes : {
        home : ruta + "/resources/views/home.php",
        inisession : ruta + "/resources/views/auth/login.php",
        register : ruta + "/resources/views/auth/register.php",
        doregister : ruta + "/app/app.php",
        
        endsession :ruta + "/app/app.php?_logout",
        login : ruta +"/app/app.php",

        miscitas : ruta +"/resources/views/admin/miscitas.php",
        newproduct : ruta +"/resources/views/admin/newproduct.php",

        prevproducts : ruta + "/app/app.php?_tp",
        singleproduct : ruta + "/app/app.php",

        allproducts : ruta +"/app/app.php?_tpe", //trae los productos a editar
        updateproduct : ruta +"/app/app.php",
        deleteproduct : ruta+"/app/app.php",
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
    pc: $('#product-card'),
    pce: $('#product-card-edit'),
    lpt : $('#product-tintura'),
    currentType : "",

    //Filtro de productos
    listProducts: function(toggle){
        let html = `<h4>Filter Product disabled</h4>`;
        let primera = true;
        console.log(toggle);
        const tta = toggle === 'tintura' ? " active" : "";
        const tcds = toggle === 'cds' ? " active" : "";
        const tcrs = toggle === 'curso' ? " active" : "";
        this.fp.html("");
        html= `
        <ul class="list-group">
            <li class="list-group-item list-group-item-action ${tta}" onclick="app.productView('tintura', event)">Tinturas</li>
            <li class="list-group-item list-group-item-action ${tcds}" onclick="app.productView('cds', event)">Dioxido de cloro</li>
            <li class="list-group-item list-group-item-action ${tcrs}" onclick="app.productView('curso', event)">Cursos</li>            
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
                    if(product.type === tipo){
                        if (counter % 4 === 0 && counter !== 0) {
                            html += `</div><div class="row">`; // Cierra y abre una nueva fila después de cada grupo de 4 elementos
                        }
                        html += `
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3"> <!-- Se ajusta el número de columnas según el tamaño de pantalla -->
                            <div class="card" style="width: 14rem; transition: transform 0.3s;">
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
                html += `</div>`;
                this.pc.html(html);
            }
        })
        .catch(err => console.error(err));
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
        console.log(productID);
        fetch(this.routes.singleproduct+ "?_vp&pid="+ pid)
        .then(resp => resp.json())
        .then(presp => {
            const product = JSON.parse(presp);
            let html=`
                <label for="product_name" class="form-label">Titulo</label>
                <input type="text" name="product_name" id="product_name" class="form-control" value="${product[0].product_name}" aria-label="product_name">    

            <img src="/cisnatura/app/pimg/${product[0].thumb}" class="card-img-top" alt="...">
                <label for="thumb" class="form-label">Cambiar Imagen del producto</label>
                <input class="form-control" name="thumb" type="file" id="thumb" required>
                
                <div class="input-group">
                    <span class="input-group-text">Descripcion</span>
                    <textarea class="form-control" type="text" name="description" id="description" value="" aria-label="product_name">${product[0].description}</textarea>
                </div>

                <label for="price" class="form-label">Cambiar Precio</label>
                <input type="text" name="price" class="form-control" value="${product[0].price}" aria-label="price">
                
            <div class="modal-footer">
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" onclick="app.deleteProduct(${productID})">Quitar producto<i class="bi bi-trash mx-1"></i></button>
                    <button type="button" class="btn btn-primary" onclick="">Guardar cambios</button>
                </div>
            </div>
            
            `;
            document.getElementById("productModalBodyEdit").innerHTML = html;
            $("#productModalEdit").modal("show"); // Muestra el modal
        }).catch(err => console.error(err))
        
        /**proceso de actualizacion */

        const productName = document.getElementById("product_name").value;
        const productDescription = document.getElementById("description").value;
        const productPrice = document.getElementById("price").value;
        const thumbFile = document.getElementById("thumb").files[0];

        const formData = new FormData();
        formData.append("product_name", productName);
        formData.append("description", productDescription);
        formData.append("price", productPrice);
        formData.append("thumb", thumbFile);

        fetch(this.routes.updateproduct + "?_ep&pid=" + productID, {
            method: "POST",
            body: formData
        })
        .then(resp => resp.json())
        .then(data => {
            if(data.ok){
                this.productEdit();
            }
            console.log("Producto actualizado:", data);
        })
        .catch(err => console.error(err));
    
        $("#productModalEdit").modal("hide");
    },
    guardarCambios : function(productID){
        const productName = document.getElementById("product_name").value;
        const productDescription = document.getElementById("description").value;
        const productPrice = document.getElementById("price").value;
        const thumbFile = document.getElementById("thumb").files[0];

        const formData = new FormData();
        formData.append("product_name", productName);
        formData.append("description", productDescription);
        formData.append("price", productPrice);
        formData.append("thumb", thumbFile);

        fetch(this.routes.updateproduct + "?_ep&pid=" + productID, {
            method: "POST",
            body: formData
        })
        .then(resp => resp.json())
        .then(data => {
            if(data.ok){
                this.productEdit();
            }
            console.log("Producto actualizado:", data);
        })
        .catch(err => console.error(err));
    
        $("#productModalEdit").modal("hide");
        //aqui se deben recibir los datos nuevos para enviar la peticion al app.php para actualizar
    },
    deleteProduct : function(productID){
        const confirmado = confirm("Desea eliminar este producto?");
        if(confirmado){
            fetch(this.routes.deleteproduct + "?_dp=" + productID)
                .then(resp => resp.json())
                .then(data =>{
                    if (data.r === "success") {
                        let html=`
                            <div class="alert alert-warning d-flex align-items-center" role="alert">
                            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                            <div>
                                ¿Esta seguro de eliminar este producto?
                            </div>
                            </div>
                        `;
                        document.getElementById("deleteProductModalBody").innerHTML = html;
                        $("#deleteProductModalBody").modal("show"); // Muestra el moda

                        this.productEdit(); // Actualizar la lista de citas después de eliminar
                    } else {
                        alert("No se pudo borrar");
                    }
                }).catch(err => console.error(err));            
        }
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
            this.lpt.html(html);            
          })
          .catch(err => console.error(err));
    },
    //Comprar
    comprarProducto(pid){
        alert("Redirigiendo a pagar..");
    },
    agregarProducto(pid){
        alert("Agregado al carrito");
    },
      
}

