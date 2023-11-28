<?php 
include_once 'conexao.php';
$pdo = conectar();
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>C3 Soluções</title>
    <link rel="stylesheet" type="text/css" href="index.css"/>
  </head>
  <body style="background-color: #dcdcdc; color: white">
    <header class="header fixed-header">
      <nav>
        <a>(45)3442-1642|c3solucao@gmail.com</a>
        <img src="logo2.png" alt="" class="logo-image" />
        <ul class="navigation">
          <li><a href="login.php">Login</a></li>
         
        </ul>
      </nav>
    </header>

    <div class="carousel-container">
      <div class="carousel-slide">
        <img src="container4.jpg" alt="Imagem 1" class="carousel-img">
        <div class="overlay"></div>
      </div>
      <div class="carousel-slide">
        <img src="container2.jpg" alt="Imagem 2" class="carousel-img">
        <div class="overlay"></div>
      </div>
      <div class="carousel-slide">
        <img src="container1.jpg" alt="Imagem 3" class="carousel-img">
        <div class="overlay"></div>
      </div>
      <div class="carousel-indicators">
        <span class="carousel-indicator active"></span>
        <span class="carousel-indicator"></span>
        <span class="carousel-indicator"></span>
      </div>
      <!-- <a href="testedeproduto.php"><button class="centered-button" id="compreAquiButton" onclick="addPressedClass()">COMPRE AQUI</button></a> -->
    </div>

    <br>
    <br>
    
    <h1>POR QUE COMPRAR NA C3 SOLUÇÕES?</h1>
    <div class="container">
      <div class="reason">
        <h2>Qualidade Impecável</h2>
        <p>Na C3 Soluções, a qualidade é nossa prioridade número um. Todos os nossos containers são fabricados com materiais de primeira qualidade e passam por rigorosos controles de qualidade para garantir durabilidade e resistência. Você pode confiar em nossos produtos para proteger seus bens e atender às suas necessidades de armazenamento.</p>
      </div>
      <div class="reason">
        <h2>Variedade de Opções</h2>
        <p>Oferecemos uma ampla gama de containers modulares e marítimos para atender às suas necessidades específicas. Seja para fins de transporte, armazenamento, conversão em espaços habitáveis, ou qualquer outra aplicação, temos o container certo para você.</p>
      </div>
      <div class="reason">
        <h2>Soluções Personalizadas</h2>
        <p>Entendemos que cada cliente é único e tem necessidades diferentes. Oferecemos soluções personalizadas para garantir que você obtenha exatamente o que procura. Nossa equipe dedicada está pronta para ajudar a criar a solução perfeita para você.</p>
      </div> 
    </div>
    
    <br>
    <br>
    
    <section class="historia">
      <div class="overlay"></div>
      <img src="container8.jpg" alt="Imagem de Nossa História">
      <div class="content">
        <h3>Nossa História</h3>
        <p>A empresa surgiu no ano de 2006. No início o negócio era de manutenção e conserto de cadeiras. Como foi percebido a necessidade dos clientes no ramo de marcenaria, foi aumentando conforme a necessidade de mercado, dessa forma conseguindo suprir as necessidades dos clientes. Atualmente a empresa investe na fabricação de containers modulares e transformação de containers marítimos e também no ramo moveleiro.</p>
      </div>
    </section>

    <!-- Adicione esta seção abaixo da última div com a classe "reason" -->

    <section class="image-section">
      <div class="image-container">
        <img src="container1.jpg" alt="Descrição da Imagem 1" class="image">
        <p class="image-description">Um container lanchonete é uma estrutura modular e móvel projetada para abrigar uma lanchonete completa. Feito de materiais duráveis, possui espaços específicos para cozinha, atendimento ao cliente e armazenamento. Sua mobilidade facilita participação em eventos e exploração de novos mercados. Personalizável, oferece uma solução prática e econômica para empreendedores no setor de alimentos.</p>
      </div>
      <div class="image-container">
        <img src="container17.jpg" alt="Descrição da Imagem 2" class="image">
        <p class="image-description">Um container depósito é uma solução eficiente para armazenamento em diversos contextos. Fabricado com materiais resistentes, esse tipo de container oferece um espaço seguro e protegido para o armazenamento de mercadorias, equipamentos ou materiais diversos. Com sua estrutura robusta e hermética, o container depósito protege os itens armazenados contra condições climáticas adversas e possíveis danos externos.</p>
      </div>
      <div class="image-container">
        <img src="container5.jpg" alt="Descrição da Imagem 2" class="image">
        <p class="image-description">Um container escritório é uma solução modular e versátil para espaços de trabalho. Construído com materiais duráveis, oferece ambientes bem organizados para atividades profissionais. Sua estrutura compacta inclui áreas para estações de trabalho, reuniões e armazenamento. A mobilidade permite fácil transporte e instalação em diferentes locais, atendendo às necessidades de empresas em constante movimento.</p>
      </div>
    </section>
    
    <section class="curiosities-section">
      <div class="curiosity">
        <div class="image-container">
          <img src="containerdesenho.png" alt="Imagem 1" class="image">
        </div>
        <p>Além do transporte de carga, os contêineres modulares são utilizados em diversas aplicações, incluindo construção de casas e escritórios, abrigos temporários em situações de emergência, lojas pop-up, instalações médicas móveis, entre outras.</p>
      </div>
      <div class="curiosity">
        <div class="image-container">
          <img src="ecoimg.png" alt="Imagem 2" class="image">
        </div>
        <p>Reutilizar contêineres modulares para outras finalidades pode ser considerado uma forma de sustentabilidade, uma vez que reduz a quantidade de resíduos e recursos necessários para construir novas estruturas.</p>
      </div>
      <div class="curiosity">
        <div class="image-container">
          <img src="imagem3.png" alt="Imagem 3" class="image">
        </div>
        <p>Muitas pessoas têm se dedicado a transformar contêineres modulares em espaços criativos e funcionais. Eles podem ser adaptados para se tornarem cafés, restaurantes, estúdios de arte, bibliotecas, salas de aula e até mesmo residências.</p>
      </div>
      <div class="curiosity">
        <div class="image-container">
          <img src="tranporteimg.png" alt="Imagem 4" class="image">
        </div>
        <p>Uma das principais vantagens dos contêineres modulares é sua portabilidade. Eles podem ser facilmente transportados para qualquer localização, seja por mar, ferrovia ou caminhão.</p>
      </div>
    </section>

    <footer class="footer">
      <div class="footer-content">
        <div class="logo">
          <img src="logo2.png" alt="Logo da Empresa">
        </div>
        <div class="footer-links">
          <h3>© Daniela e Victoria 2023. Todos Os Direitos Reservados.</h3>
        </div>
      </div>
    </footer>

    <script>
      document.addEventListener("DOMContentLoaded", function () {
        const button = document.getElementById("compreAquiButton");

        button.addEventListener("click", function () {
          // Adiciona a classe "pressed" ao botão
          button.classList.add("pressed");
        });
      });

      document.addEventListener("DOMContentLoaded", function () {
        let currentSlide = 0;
        const slides = document.querySelectorAll(".carousel-slide");
        const indicators = document.querySelectorAll(".carousel-indicator");
        const images = document.querySelectorAll(".carousel-img");
        let interval;

        function showSlide(index) {
          slides[currentSlide].style.display = "none";
          indicators[currentSlide].classList.remove("active");

          currentSlide = (index + slides.length) % slides.length;

          slides[currentSlide].style.display = "block";
          indicators[currentSlide].classList.add("active");
        }

        function nextSlide() {
          showSlide(currentSlide + 1);
        }

        function prevSlide() {
          showSlide(currentSlide - 1);
        }

        interval = setInterval(nextSlide, 5000);

        for (let i = 0; i < indicators.length; i++) {
          indicators[i].addEventListener("click", () => {
            showSlide(i);
            clearInterval(interval);
          });
        }

        showSlide(currentSlide);

        images.forEach((img, index) => {
          img.addEventListener("mouseover", () => {
            showSlide(index);
            clearInterval(interval);
          });

          img.addEventListener("mouseout", () => {
            // Retornar ao slide original se o mouse sair da imagem
            showSlide(currentSlide);
            interval = setInterval(nextSlide, 5000);
          });
        });
      });
    </script>
  </body>
</html>
