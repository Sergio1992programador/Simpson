export function renderHeader() {
  let isLoggedIn = localStorage.getItem("token");

  const header = document.createElement("header");

  const nav = document.createElement("nav");
  nav.className = "navbar navbar-expand-lg navbar-dark bg-dark";
  nav.id = "navbar";

  const container = document.createElement("div");
  container.className = "container-fluid";

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

  const toggler = document.createElement("button");
  toggler.className = "navbar-toggler";
  toggler.type = "button";
  toggler.setAttribute("data-bs-toggle", "collapse");
  toggler.setAttribute("data-bs-target", "#menu");
  toggler.setAttribute("aria-controls", "menu");
  toggler.setAttribute("aria-expanded", "false");
  toggler.setAttribute("aria-label", "Menú");

  const togglerIcon = document.createElement("span");
  togglerIcon.className = "navbar-toggler-icon";
  toggler.appendChild(togglerIcon);

  const collapse = document.createElement("div");
  collapse.className = "collapse navbar-collapse";
  collapse.id = "menu";

  const ul = document.createElement("ul");
  ul.className = "navbar-nav ms-auto";

  const links = [
    {
      text: "Inicio",
      href: "http://localhost/lossimpson/Frontend/index.html"
    },
    {
      text: "Sobre nosotros",
      href: "#sobre"
    },
    {
      text: "Contacto",
      href: "#contacto"
    },
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
    }
  ];

  links.forEach(({ text, href, onClick }) => {
    const li = document.createElement("li");
    li.className = "nav-item";

    const a = document.createElement("a");
    a.className = "nav-link";
    a.textContent = text;

    if (onClick) {
      a.href = "#";
      a.onclick = (e) => {
        e.preventDefault();
        onClick();
      };
    } else {
      a.href = href;
    }

    li.appendChild(a);
    ul.appendChild(li);
  });

  collapse.appendChild(ul);
  container.appendChild(brandLink);
  container.appendChild(toggler);
  container.appendChild(collapse);
  nav.appendChild(container);
  header.appendChild(nav);

  document.body.insertBefore(header, document.body.firstChild);
  return header;
}