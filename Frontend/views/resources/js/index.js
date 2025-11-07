import { card } from '../../components/card.js';
import { renderFooter } from '../../components/footer.js';
import { renderHeader } from '../../components/header.js';

// 1. Renderizar el encabezado
renderHeader();

// 2. Verificar si el usuario está logueado
const isLoggedIn = Boolean(localStorage.getItem("token"));

// 3. Definir las tarjetas
const cards = [
    {
        id: "personajes",
        nombre: "Personajes",
        enlace: isLoggedIn
            ? "http://localhost/lossimpson/Frontend/views/personajes.html"
            : "http://localhost/lossimpson/Frontend/index.html",
        imagen: "personajes1.png",
        titulo: "Todos los personajes",
        descripcion:
            "<p>Aquí, podrás ver a todos los personajes más importantes de Los Simpson, conocer sus historias, curiosidades y descubrir por qué cada uno de ellos ha dejado una huella inolvidable en la cultura popular.</p><br>",
    },
    {
        id: "familias",
        nombre: "Familias",
        enlace: isLoggedIn
            ? "http://localhost/lossimpson/views/familias.html"
            : "controller/sinverificado.php",
        imagen: "familias.webp",
        titulo: "Familias importantes",
        descripcion:
            "<p>Aquí, podrás ver cómo se dividen las familias más importantes de Los Simpson, conocer sus integrantes, sus relaciones y el papel que cada una juega en la historia de la serie. Desde los Simpson hasta los Flanders, cada familia aporta su propio estilo, valores y momentos inolvidables.</p><br>",
    },
    {
        id: "video",
        nombre: "Videojuego",
        enlace: isLoggedIn
            ? "http://localhost/lossimpson/views/videojuego.html"
            : "controller/sinverificado.php",
        imagen: "video.png",
        titulo: "Videojuego de los Simpson",
        descripcion:
            "<p>Aquí, podrás ver a Bart Simpson en plena acción, saltando con su skate. Con su actitud rebelde y su energía imparable, Bart se convierte en el protagonista de esta aventura.</p><br>",
    },
    {
        id: "tienda",
        nombre: "Tienda Simpson",
        enlace: isLoggedIn
            ? "http://localhost/lossimpson/views/tienda.php"
            : "controller/sinverificado.php",
        imagen: "tienda.png",
        titulo: "Tienda de los Simpson",
        descripcion:
            "<p>Aquí, accederás a la tienda donde podrás comprar productos de Los Simpson.</p><br>",
    },
];

// 4. Renderizar las cartas en el contenedor
function loadCards() {
    const container = document.querySelector("#category-container");

    if (!container) {
        console.error("No se encontró el contenedor #category-container");
        return;
    }

    cards.forEach((cardData) => {
        const carta = {
            id: cardData.id,
            imagen: `/lossimpson/img/${cardData.imagen}`,
            nombre: cardData.nombre,
            titulo: cardData.titulo,
            descripcion: cardData.descripcion,
            enlace: cardData.enlace,
        };

        container.appendChild(card(carta));
    });
}

// 5. Ejecutar funciones principales
loadCards();
renderFooter();