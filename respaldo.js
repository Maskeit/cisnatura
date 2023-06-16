pc : $('#product-card'),

productView: function() {
    let html = `<h2>No hay productos disponibles todavía</h2>`;
    this.pc.html("");
    fetch(this.routes.prevproducts)
    .then(resp => resp.json())
    .then(presp => {
        console.log(presp);
        const products = JSON.parse(presp); // Convertir la cadena JSON a objeto JavaScript
        if (products.length > 0) {
            html = "";
            for (let product of products) {
                html += `
                <div class="col">
                    <div class="card" style="width: 18rem; transition: transform 0.3s;">
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
                            <p class="card-text">${product.description}</p>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="button" class="btn btn-success">COMPRAR</button>
                                <a href="#" class="btn btn-link link-success"><i class="bi bi-bag-plus"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                `;
            }
            this.pc.html(html);
        }
    })
    .catch(err => console.error(err));
},

/// Diseño para web bien
productView: function() {
  let html = `<h2>No hay productos disponibles todavía</h2>`;
  this.pc.html("");
  fetch(this.routes.prevproducts)
  .then(resp => resp.json())
  .then(presp => {
      const products = JSON.parse(presp); // Convertir la cadena JSON a objeto JavaScript
      if (products.length > 0) {
          html = `<div class="row row-cols-4">`; // Agrega la clase 'row-cols-4' para 4 columnas por fila
          let counter = 0;
          for (let product of products) {
              if (counter % 4 === 0 && counter !== 0) {
                  html += `</div><div class="row row-cols-4">`; // Cierra y abre una nueva fila después de cada grupo de 4 elementos
              }
              html += `
              <div class="col">
                  <div class="card" style="width: 18rem; transition: transform 0.3s;">
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
                          <p class="card-text">${product.description}</p>
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
}