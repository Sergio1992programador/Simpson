import { card } from '../../components/card.js';
import { renderFooter } from '../../components/footer.js';
import { renderHeader } from '../../components/header.js';

// 1. Cargar el header inmediatamente
// const userId = sessionStorage.getItem("user_id"); // o localStorage, según tu lógica
// const isLoggedIn = !!userId;
renderHeader();

function loadPersonajes() {

  const params = new URLSearchParams(window.location.search);
  const familiaId = params.get("f");
  const API_URL = familiaId
    ? `http://localhost/lossimpson/Backend/public/personajes?f=${familiaId}`
    : "http://localhost/lossimpson/Backend/public/personajes";

  fetch(API_URL)
    .then((res) => res.json())
    .then((data) => {
      const container = document.querySelector("#character-container");

      data.forEach(personaje => {
        const carta = {
          id: personaje.id,
          imagen: `/lossimpson/img/${personaje.imagen}`,
          nombre: personaje.nombre,
          titulo: personaje.titulo,
          descripcion: personaje.descripcion,
          enlace: `http://localhost/lossimpson/Frontend/views/detalle_personaje.html?id=${personaje.id}`,
        };

        container.appendChild(card(carta));
      });
    })
    .catch(error => {
      console.error("Error al cargar personajes:", error);
    });
}

loadPersonajes();
renderFooter();