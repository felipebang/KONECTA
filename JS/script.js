const icono = document.querySelector(".search");
const buscar = document.querySelector(".busqueda_form");

icono.addEventListener("click", () =>{
    buscar.classList.toggle("active")
});

const menu = document.querySelector(".icon");
const lista = document.querySelector("ul");

menu.addEventListener("click", () =>{
    lista.classList.toggle("responsive")
});




