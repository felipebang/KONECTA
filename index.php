<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>konecta</title>

  <!--cdn de iconos-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <!--style del navbar-->
  <link rel="stylesheet" href="./CSS/navbar.css">
  <!--style del footer-->
  <link rel="stylesheet" href="./CSS/footer.css">
  <!--style del Rsposive-->
  <link rel="stylesheet" href="./CSS/responsive.css">
    <!--Favicon-->
    <link rel="shortcut icon" href="./IMG/media.png" type="image/x-icon">

  </head>
  <body>
   

  <header>
      <nav class="navbar">
        <div class="cont-logo">
          <img class="logo" src="./img/Restaurant.png" alt="logo" />
        </div>

        <div class="cont-logo-media">
        <img class="logo-media" src="./img/Restaurant.png" alt="logo" />
      </div>

        <div class="cont-ul">
          <ul class="lista">
            <li><a class="active__inicio" href="#">Inicio</a></li>
            <li><a href="./vista/V-products.php">Productos</a></li>
            <li><a href="./contacto.php">Contacto</a></li>
          </ul>
        </div>

    

        <div class="cont-bars">
          <img class="icon" src="./IMG/Restaurant.png" alt="bars" />
        </div>

      </nav>
    </header>



    <section class="landy">
      <div class="cont-landy">
        <h3 class="cont-landy__title">konecta</h3>
        <p class="cont-landy__p">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis
          impedit sed consequatur consectetur inventore pariatur nulla deserunt
          repellat est explicabo.
        </p>
        <a href="./vista/V-products.php" class="cont-landy__a">
          Productos
        </a>
      </div>
      <div class="cont-landy-img">
        <img
          src="./IMG/2patryk-gauza-vs0tzSHVcac-unsplash.jpg"
          alt="img-landy"
        />
      </div>
      
    </section>

    <!--Footer-->
    <footer>
      <div class="cont-footer">
        <div class="nombre">
          <h3>konecta</h3>
        </div>
        <div class="cont-text">
          <p>
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum
            harum minus laudantium, placeat libero sit in alias corrupti
            necessitatibus similique magnam et reprehenderit blanditiis earum
            quis atque nam dignissimos maiores?
          </p>
        </div>
        <div class="cont-icon">
          <img src="./img/facebook.png" alt="Red-social" />
          <img src="./img/instagram.png" alt="Red-social" />
          <img src="./img/whatsapp.png" alt="Red-social" />
        </div>
      </div>
      <div class="copy">
        <small
          >&copy; 2022 <b>konecta</b> - Todos los Derechos Reservados.</small
        >
      </div>
    </footer>

    <script>
      const menu = document.querySelector(".icon");
const lista = document.querySelector("ul");

menu.addEventListener("click", () =>{
    lista.classList.toggle("responsive")
});
    </script>

  <!--Code javaScript-->
  <script src="./JS/script.js"></script>
  <script src="./JS/cart.js"></script>
  <script src="./JS/login.js"></script>

  </body>
</html>