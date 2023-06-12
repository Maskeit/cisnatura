getMyCitas: function () {
    const itemsPerPage = 10; // Cantidad de citas por página
    let currentPage = 1; // Página actual
  
    const fetchCitas = () => {
      let html = `<tr><td colspan="3">Aún no tiene citas</td></tr>`;
      this.mc.html("");
      fetch(this.url + "?_mc")
        .then((resp) => resp.json())
        .then((mcresp) => {
          if (mcresp.length > 0) {
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;
            const citasToShow = mcresp.slice(startIndex, endIndex);
  
            html = "";
            console.log(citasToShow);
            for (let cita of citasToShow) {
              const activeIcon = cita.active === "1" ? "bi-toggle-on" : "bi-toggle-off";
              const fechaCita = new Date(cita.fecha_cita).toLocaleDateString('es-ES', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
              });
              html += `
               <tr>
                <td>${fechaCita}</td>
                <td>${cita.hora_cita}</td>
                <td>${cita.nombre_cliente}</td>
                <td>${cita.tipo_cita}</td>
                <td>${cita.telefono_cliente}</td>
                <td>
                  <a href="#" class="link-primary" id="verCita" 
                    onclick="app_mycitas.verCita(${cita.id})"><i class="bi bi-eye"></i>
                  </a>
                  <a href="#" class="link-primary mx-2" id="edCita" onclick="app_mycitas.editarCita(${cita.id})"><i class="bi bi-pencil-square"></i></a>
                  <a href="#" class="link-success" 
                    tabindex="0" data-bs-trigger="hover focus" 
                    data-bs-content="Desactivar publicacion" 
                    onclick="app_mycitas.toggleCitaActive(${cita.id})">
                    <i class="bi ${activeIcon}"></i>
                  </a>
                  <a href="#" class="link-secondary mx-2" id="deleteCita" onclick="app_mycitas.deleteCita(${cita.id})"><i class="bi bi-trash"></i></a>
                </td>
               </tr>
               `;
            }
          }
          this.mc.html(html);
          setupPagination(mcresp.length, itemsPerPage, currentPage, fetchCitas);
        })
        .catch((err) => console.error(err));
    };
  
    const setupPagination = (totalItems, itemsPerPage, currentPage, onPageChange) => {
      const paginationElement = document.getElementById("pagination");
      const totalPages = Math.ceil(totalItems / itemsPerPage);
  
      // Crea los enlaces de paginación
      let paginationHTML = "";
      for (let page = 1; page <= totalPages; page++) {
        const activeClass = page === currentPage ? "active" : "";
        paginationHTML += `<a href="#" class="page-link ${activeClass}" data-page="${page}">${page}</a>`;
      }
  
      // Agrega los enlaces de paginación al elemento correspondiente
      paginationElement.innerHTML = paginationHTML;
  
      // Agrega el evento de clic a los enlaces de paginación
      const paginationLinks = paginationElement.getElementsByClassName("page-link");
      for (let link of paginationLinks) {
        link.addEventListener("click", (e) => {
          e.preventDefault();
          const page = parseInt(e.target.dataset.page);
          onPageChange(page);
        });
      }
    };
  
    // Configuración inicial
    const paginationElement = document.getElementById("pagination");
    paginationElement.innerHTML = ""; // Limpia el contenido de paginación
  
    // Obtener las citas en la página inicial
    fetchCitas();
  },
  