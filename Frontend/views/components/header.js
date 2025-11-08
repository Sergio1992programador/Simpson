export function renderHeader() {
  let isLoggedIn = localStorage.getItem("token");
  const header = document.createElement("header");
  header.className = "bg-primary sticky-top z-3";

  const nav = document.createElement("nav");
  nav.className = "navbar navbar-expand-lg py-0";
  nav.id = "navbar";

  const container = document.createElement("div");
  container.className = "container-fluid text-dark";

  const brandLink = document.createElement("a");
  brandLink.className = "navbar-brand";
  brandLink.href = "#";

  const h1 = document.createElement("h1");
  h1.textContent = "Los Simpson ";

  const bartImg = document.createElement("img");
  bartImg.id = "barto";
  bartImg.src = "http://localhost/lossimpson/img/bartt.png";
  bartImg.alt = "Bart";
  bartImg.className = "w-auto";
  bartImg.style.height = "100px";

  h1.appendChild(bartImg);
  brandLink.appendChild(h1);

  const collapse = document.createElement("div");
  collapse.className = "collapse navbar-collapse";
  collapse.id = "menu";

  const ul = document.createElement("ul");
  ul.className = "navbar-nav ms-auto";

  const links = [
    { text: "Inicio", onClick: () => window.location.href = "http://localhost/lossimpson/Frontend/index.html" },
    { text: "Sobre nosotros", onClick: () => window.location.href = "#sobre" },
    { text: "Contacto", onClick: () => window.location.href = "#contacto" },
    {
      text: isLoggedIn ? "Cerrar sesión" : "Iniciar sesión",
      onClick: () => {
        if (isLoggedIn) {
          localStorage.removeItem("token");
          window.location.href = window.location.href;
        } else {
          window.location.href = "http://localhost/lossimpson/Frontend/views/login.html";
        }
      }
    },
  ];

  links.forEach(({ text, onClick }) => {
    const li = document.createElement("li");
    li.className = "nav-item";

    const button = document.createElement("button");
    button.className = "nav-link btn btn-link text-dark fs-5 px-3 py-2 custom-hover";
    button.textContent = text;
    button.onclick = onClick;

    li.appendChild(button);
    ul.appendChild(li);
  });

  collapse.appendChild(ul);
  container.appendChild(brandLink);
  container.appendChild(collapse);
  nav.appendChild(container);
  header.appendChild(nav);

  document.body.insertBefore(header, document.body.firstChild);
  return header;
}
