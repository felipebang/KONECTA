//cart
const cart = document.querySelector(".cont-carrito");
const cuerpo = document.querySelector(".cont-cart-ver");

cart.addEventListener("click", () =>{
    cuerpo.classList.toggle("cart")
});

//alert("esta funcionado");