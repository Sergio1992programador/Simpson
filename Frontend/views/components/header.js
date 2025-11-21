export function renderHeader() {
  let isLoggedIn = localStorage.getItem("token");

  const header = document.createElement("header");

  const nav = document.createElement("nav");
  nav.className = "navbar navbar-expand-lg navbar-dark bg-dark";
  nav.id = "navbar";

  const container = document.createElement("div");
  container.className = "container-fluid";

  // H1 como título principal
  const h1 = document.createElement("h1");
  h1.textContent = "Los Simpson ";

  const bartImg = document.createElement("img");
  bartImg.id = "barto";
  bartImg.src = "http://localhost/lossimpson/img/bartt.png";
  bartImg.alt = "Bart";
  bartImg.className = "w-auto";
  bartImg.style.height = "100px";

  h1.appendChild(bartImg);

  // Al pulsar el h1, redirige al inicio
  h1.style.cursor = "pointer";
  h1.onclick = () => {
    window.location.href = "http://localhost/lossimpson/Frontend/index.html";
  };

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

  // Links
  const links = [
    {
      text: "Tienda",
      href: "http://localhost/lossimpson/Frontend/views/tienda.html"
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
          localStorage.removeItem("victoriaShown"); // reset para que vuelva a mostrarse al próximo login
          // Mostrar imagen escondido.png al cerrar sesión
          const img = document.createElement("img");
          img.src = "http://localhost/lossimpson/img/escondido.png";
          img.alt = "Cerrar sesión";
          img.style.height = "80px";
          img.style.width = "auto";
          img.style.marginLeft = "10px";
          ul.appendChild(img);

          setTimeout(() => {
            window.location.href = window.location.href;
          }, 800);
        } else {
          window.location.href =
            "http://localhost/lossimpson/Frontend/views/login.html";
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
  container.appendChild(h1);
  container.appendChild(toggler);
  container.appendChild(collapse);
  nav.appendChild(container);
  header.appendChild(nav);

  document.body.insertBefore(header, document.body.firstChild);

  // ✅ Mostrar victoria.png solo la primera vez que se entra logueado
  if (isLoggedIn && !localStorage.getItem("victoriaShown")) {
    const img = document.createElement("img");
    img.src = "http://localhost/lossimpson/img/victoria.png";
    img.alt = "Inicio de sesión correcto";
    img.style.height = "80px";
    img.style.width = "auto";
    img.style.marginLeft = "10px";
    ul.appendChild(img);

    // Marcamos que ya se mostró
    localStorage.setItem("victoriaShown", "true");

    // Se elimina tras 3 segundos
    setTimeout(() => {
      img.remove();
    }, 800);
  }

  return header;
}