//Login

const boton = document.querySelector(".login");
const loguear = document.querySelector(".cont-login");

boton.addEventListener("click", () =>{
    loguear.classList.toggle("iniciar")
});


const ico = document.querySelector(".respont");
const mostrar = document.querySelector(".cont-login");

ico.addEventListener("click", () =>{
    mostrar.classList.toggle("mostrar")
});

