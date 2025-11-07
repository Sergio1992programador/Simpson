export function renderFooter() {
    const footer = document.createElement("footer");
    footer.className = "d-flex justify-content-evenly flex-wrap bg-primary text-dark fs-5 p-4";

    const copyright = document.createElement("strong");
    copyright.innerHTML = "&copy; Todos los derechos reservados Sergio 2025";

    footer.appendChild(copyright);
    document.body.appendChild(footer);
    return footer;
}