<!DOCTYPE html>
<html>
  <head>
    <title>C3 Solução</title>
    <link rel="stylesheet" type="text/css" href="pagina.css" />
  </head>
  <body style="background-color: #dcdcdc; color: white">
    <header class="header">
      <nav>
        <a>(45)3442-1642|c3solucao@gmail.com</a>
        <img src="logo1.png" alt="" class="logo-image" />
        <ul class="navigation">
          <li><a href="cliente.php">Cadastrar-se</a></li>
          <li><a href="vmr.ver.php">Produtos</a></li>
        </ul>
      </nav>
    </header>

    <div class="carousel-container">
        <div class="carousel-slide">
            <img src="container4.jpg" alt="container1.png.jpeg">
            <div class="overlay"></div>
        </div>
        <div class="carousel-slide">
            <img src="container2.jpg" alt="container3.png.jpeg">
            <div class="overlay"></div>
        </div>
        <div class="carousel-slide">
            <img src="container1.jpg" alt="container5.png.jpeg">
            <div class="overlay"></div>
        </div>
        <div class="carousel-indicators">
            <span class="carousel-indicator active"></span>
            <span class="carousel-indicator"></span>
            <span class="carousel-indicator"></span>
        </div>
        <!-- <button class="button"><a href="vmr.ver.php" class="no-visited-style">COMPRE JÁ</a></button> -->

    </div>


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

        

        <div class="imagem-container">
  <img src="paginahist.png" alt="Descrição da imagem" class="imagem-full-width" />
</div>




       

    <!--home section starts-->

    
        <div class="content">
          <h3 class="section-title">Curiosidades</h3>
          <style>
            
            p {
              margin-bottom: 20px; 
            }
          </style>

          <!-- Seu código HTML com parágrafos -->
          <p>
            • Versatilidade: Além do transporte de carga, os contêineres
            modulares são utilizados em diversas aplicações, incluindo
            construção de casas e escritórios, abrigos temporários em situações
            de emergência, lojas pop-up, instalações médicas móveis, entre
            outras.
          </p>
          <p>
            • Sustentabilidade: Reutilizar contêineres modulares para outras
            finalidades pode ser considerado uma forma de sustentabilidade, uma
            vez que reduz a quantidade de resíduos e recursos necessários para
            construir novas estruturas.
          </p>
          <p>
            • Transformações Criativas: Muitas pessoas têm se dedicado a
            transformar contêineres modulares em espaços criativos e funcionais.
            Eles podem ser adaptados para se tornarem cafés, restaurantes,
            estúdios de arte, bibliotecas, salas de aula e até mesmo
            residências.
          </p>
          <p>
            • Portabilidade: Uma das principais vantagens dos contêineres
            modulares é sua portabilidade. Eles podem ser facilmente
            transportados para qualquer localização, seja por mar, ferrovia ou
            caminhão.
          </p>
        </div>
      </div>
    </section>
    <!--about section starts-->


    <footer class="footer">
      <div class="footer-content">
        <div class="footer-links">
          <a href="formulariodecadastro.html">Login</a>
          <a href="carrinho.html">Produtos</a>
        </div>
        <div id="linha-vertical"></div>
        <div class="social-media-links">
          <a href="https://www.facebook.com/douglas.luz.9210?mibextid=LQQJ4d">Facebook</a>
          <a href="https://www.instagram.com/c3solucao/?igshid=MzRlODBiNWFlZA%3D%3D">Instagram</a>
        </div>
      </div>
    </footer>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.carousel-indicator');

        function showSlide(index) {
            slides[currentSlide].style.display = 'none';
            indicators[currentSlide].classList.remove('active');

            currentSlide = (index + slides.length) % slides.length;

            slides[currentSlide].style.display = 'block';
            indicators[currentSlide].classList.add('active');
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        const interval = setInterval(nextSlide, 5000); // Troca de slide a cada 3 segundos

        for (let i = 0; i < indicators.length; i++) {
            indicators[i].addEventListener('click', () => {
                showSlide(i);
                clearInterval(interval); // Pára o intervalo quando um indicador é clicado
            });
        }

        // Exibir o primeiro slide ao carregar a página
        showSlide(currentSlide);
    </script>
    

    
  </body>
</html>