const app_car = {
    url : "/cisnatura/app/app.php",
    user : {
        sv : false,
        id : "",
        tipo : "",
    },

    pe : $('#pedido'),

    contentCar: function(uid) {
        const idUser = uid;
        let html = "<h4 class='lead text-muted d-flex justify-content-center'>Todo esta tranquilo por aqui...</h4>";
        this.pe.html("");
        fetch(this.url + "?_vcar=" + idUser)
            .then(resp => resp.json())
            .then(caresp => {
                const productos = caresp;
                console.log(productos);
                if (productos.length > 0) {
                    html = "";
                    for( let product of productos ){
                        html += `
                        <tr>
                            <td>${product.product_name}</td>
                            <td><img src="/cisnatura/app/pimg/${product.thumb}" class="card-img-top" style="max-width: 100px;"></td>
                            <td>${product.extracto}</td>
                            <td>${product.cantidad}</td>
                            <td>${product.price}</td>
                            <td>${(product.price)*(product.cantidad)}</td>
                            <td><a href="#" onclick="app_car.delProduct(${product.id},${idUser})"><i class="bi bi-trash"></i></a></td>                        
                        </tr>
                        `;
                    }
                }
                this.pe.html(html);
            }).catch(err => console.error(err));
    },

    delProduct : function(pci,uid){ // product car id
        alert("Llego el producto " + pci);
        fetch(this.url + "?_pci=" + pci)
        .then(resp => resp.json())
        .then(data => {
            if (data.r === "success") {
                this.contentCar(uid); // Actualizar la lista de citas después de eliminar
            } else {
                alert("No se pudo borrar");
            }
        }).catch( err => console.error(err));
    },

}