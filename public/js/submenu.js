//submenu de postulados
document.addEventListener("DOMContentLoaded", function () {
    const postuladosElement = document.getElementById("postulados");
    const subMenu = postuladosElement.nextElementSibling;

    postuladosElement.addEventListener("click", function (event) {
        event.stopPropagation(); // Evitar que el evento click se propague a elementos superiores
        subMenu.classList.toggle("show");
    });

    subMenu.addEventListener("click", function (event) {
        event.stopPropagation(); // Evitar que el evento click se propague a elementos superiores
        subMenu.classList.add("show");
    });
});
document.getElementById("menuTrigger").addEventListener("click", function () {
    var menu = document.getElementById("menu");
    var menuOptions = document.querySelector(".menu-options");

    if (menu.offsetHeight === 50) {
        menu.style.height = "150px"; // Altura del menú expandido
        menuOptions.style.transform = "translateY(0)";
    } else {
        menu.style.height = "50px"; // Altura del menú colapsado
        menuOptions.style.transform = "translateY(100%)";
    }
});

//funcion para el submenu de postulantes
document.addEventListener("DOMContentLoaded", function () {
    const postulantesElement = document.getElementById("postulantes");
    const subMenu = postulantesElement.nextElementSibling;

    postulantesElement.addEventListener("click", function (event) {
        event.stopPropagation(); // Evitar que el evento click se propague a elementos superiores
        subMenu.classList.toggle("show");
    });

    subMenu.addEventListener("click", function (event) {
        event.stopPropagation(); // Evitar que el evento click se propague a elementos superiores
        subMenu.classList.add("show");
    });
});
document.getElementById("menuTrigger").addEventListener("click", function () {
    var menu = document.getElementById("menu");
    var menuOptions = document.querySelector(".menu-options");

    if (menu.offsetHeight === 50) {
        menu.style.height = "150px"; // Altura del menú expandido
        menuOptions.style.transform = "translateY(0)";
    } else {
        menu.style.height = "50px"; // Altura del menú colapsado
        menuOptions.style.transform = "translateY(100%)";
    }
});

//funcion para el submenu de reportes
document.addEventListener("DOMContentLoaded", function () {
    const reportesElement = document.getElementById("reportes");
    const subMenu = reportesElement.nextElementSibling;

    reportesElement.addEventListener("click", function (event) {
        event.stopPropagation(); // Evitar que el evento click se propague a elementos superiores
        subMenu.classList.toggle("show");
    });

    subMenu.addEventListener("click", function (event) {
        event.stopPropagation(); // Evitar que el evento click se propague a elementos superiores
        subMenu.classList.add("show");
    });
});
document.getElementById("menuTrigger").addEventListener("click", function () {
    var menu = document.getElementById("menu");
    var menuOptions = document.querySelector(".menu-options");

    if (menu.offsetHeight === 50) {
        menu.style.height = "150px"; // Altura del menú expandido
        menuOptions.style.transform = "translateY(0)";
    } else {
        menu.style.height = "50px"; // Altura del menú colapsado
        menuOptions.style.transform = "translateY(100%)";
    }
});
