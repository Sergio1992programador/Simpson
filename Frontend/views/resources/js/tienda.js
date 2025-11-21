import { card } from '../../components/card.js';
import { renderFooter } from '../../components/footer.js';
import { renderHeader } from '../../components/header.js';

// 1. Verificar si el usuario está logueado
const token = localStorage.getItem("token");
if (!token) {
    const currentUrl = window.location.pathname + window.location.search;
    window.location.href = `/lossimpson/Frontend/views/login.html?redirect=${encodeURIComponent(currentUrl)}`;
}

// 2. Cargar el header
renderHeader();

// 3. Cargar las familias
const API_URL = "http://localhost/lossimpson/Backend/public/tienda";

function loadTienda() {
    fetch(API_URL)
        .then((res) => res.json())
        .then((data) => {
            const container = document.querySelector("#tienda-container");

            data.forEach(tienda => {
                const carta = {
                    id: tienda.id,
                    imagen: `/lossimpson/img/${tienda.imagen}`,
                    nombre: tienda.nombre,
                    titulo: tienda.titulo,
                    descripcion: tienda.descripcion,
                    enlace: `http://localhost/lossimpson/Frontend/views/personajes.html?f=${tienda.id}`,
                };

                container.appendChild(card(carta));
            });
        })
        .catch(error => {
            console.error("Error al cargar tienda:", error);
        });
}

loadTienda();
renderFooter();
