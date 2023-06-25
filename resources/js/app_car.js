const app_car = {
    url : "/cisnatura/app/app.php",
    user : {
        sv : false,
        id : "",
        tipo : "",
    },

    pe : $('#pedido'),

    contentCar: function(uid) {
        let html = "<h3>Agrega productos al carrito </h3>";
        this.pe.html("");
        fetch(this.url + "?_vcar=" + uid)
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
                        </tr>
                        `;
                    }
                }
                this.pe.html(html);
            }).catch(err => console.error(err));
    },

}