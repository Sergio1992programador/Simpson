import { card } from '../../components/card.js';
import { renderFooter } from '../../components/footer.js';
import { renderHeader } from '../../components/header.js';

// 1. Cargar el header inmediatamente
// const userId = sessionStorage.getItem("user_id"); // o localStorage, según tu lógica
// const isLoggedIn = !!userId;
renderHeader();

// 2. Luego cargar los personajes
const API_URL = "http://localhost/lossimpson/Backend/public/familias";

function loadFamilies() {

    fetch(API_URL)
        .then((res) => res.json())
        .then((data) => {
            const container = document.querySelector("#family-container");

            data.forEach(familia => {
                const carta = {
                    id: familia.id,
                    imagen: `/lossimpson/img/${familia.imagen}`,
                    nombre: familia.nombre,
                    titulo: familia.titulo,
                    descripcion: familia.descripcion,
                    enlace: `http://localhost/lossimpson/Frontend/views/personajes.html?f=${familia.id}`,
                };

                container.appendChild(card(carta));
            });
        })
        .catch(error => {
            console.error("Error al cargar familias:", error);
        });
}

loadFamilies();
renderFooter();
