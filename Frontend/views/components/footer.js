export function renderFooter() {
    const footer = document.createElement("footer");
    footer.className = "bg-primary text-dark fs-5 p-4 mt-auto d-flex justify-content-center align-items-center";

    const copyright = document.createElement("strong");
    copyright.innerHTML = "&copy; Todos los derechos reservados Sergio 2025";

    footer.appendChild(copyright);
    document.body.appendChild(footer);
    return footer;
}
