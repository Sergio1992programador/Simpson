import { card } from '../../components/card.js';
import { renderHeader } from '../../components/header.js';

// 1. Cargar el header inmediatamente
// const userId = sessionStorage.getItem("user_id"); // o localStorage, según tu lógica
// const isLoggedIn = !!userId;
renderHeader(true);

// 2. Luego cargar los personajes
const API_URL = "http://localhost/lossimpson/Backend/public/personajes";

function loadPersonajes() {

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
          descripcion: personaje.descripcion
        };

        container.appendChild(card(carta));
      });
    })
    .catch(error => {
      console.error("Error al cargar personajes:", error);
    });
}

loadPersonajes();