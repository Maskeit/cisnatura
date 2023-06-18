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
        singleproduct : ruta + "/app/app.php",

        allproducts : ruta +"/app/app.php?_tpe", //trae los productos a editar
        updateproduct : ruta +"/app/app.php",
    },
    view : function(route){
        location.replace(this.routes[route]);
    },
    user : {
        sv : false,
        id : "",
        tipo : "",
    },

    pc: $('#product-card'),
    pce: $('#product-card-edit'),

    productView: function() {
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
                    if (counter % 4 === 0 && counter !== 0) {
                        html += `</div><div class="row">`; // Cierra y abre una nueva fila después de cada grupo de 4 elementos
                    }
                    html += `
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3"> <!-- Se ajusta el número de columnas según el tamaño de pantalla -->
                        <div class="card" style="width: 18rem; transition: transform 0.3s;" 
                        onclick="app.singleProduct(${product.id})">
                            <img src="/cisnatura/app/pimg/${product.thumb}" class="card-img-top" alt="...">
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
                                    <button type="button" class="btn btn-success">COMPRAR</button>
                                    <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                    counter++;
                }
                html += `</div>`;
                this.pc.html(html);
            }
        })
        .catch(err => console.error(err));
    },

    singleProduct : function(pid){//pid es el product id
        fetch(this.routes.singleproduct+ "?_vp&pid="+ pid)
            .then(resp => resp.json())
            .then(presp => {
                const product = JSON.parse(presp);
                console.log(product);
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
    
}

