<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Ecommerce</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #F0F8FF, #B0E0E6);
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
        }

        .container {
            width: 90%;
            margin: 0 auto;
        }

        .logo {
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 100px;
        }

        .menu {
            height: 75px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: lightblue;
            font-family: 'Arial', sans-serif;
        }

        .menu ul {
            list-style: none;
            display: flex;
        }

        .menu ul li {
            margin: 0 30px;
        }

        .menu ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s;
        }

        .menu ul li a:hover {
            color: #333333;
        }

        .menu .carrinho {
            margin-right: 20px;
        }

        .menu .carrinho img {
            height: 30px;
        }

        .banner {
            height: 100px;
            background-image: url('seu_banner.jpg'); /* Substitua 'seu_banner.jpg' pelo caminho da sua imagem de banner */
            background-size: cover;
            background-position: center;
        }

        .produtos {
            display: grid;
            grid-template-columns: repeat(4);
            gap: 20px;
            margin: 20px 0;
        }

        .produto {
            width: 300px;
            margin: 30px;
            border: 1px solid gray;
            padding: 10px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            font-family: 'Arial', sans-serif;
        }

        .produto:hover {
            transform: scale(1.05);
        }

        .produto img {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .produto h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        .produto p {
            font-size: 16px;
            color: green;
        }

        .produto button {
            width: 100%;
            height: 40px;
            background-color: #4B0082;
            color: white;
            border: none;
            cursor: pointer;
            font-family: 'Arial', sans-serif;
        }
.rodapé {
    /* position: fixed; */
    bottom: 0; /* Alinhar na parte inferior da página */
    width: 100%; /* Largura total da página */
    background-color: #333333;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100px; /* Altura do rodapé */
}

.rodapé p {
    color: white;
    font-size: 20px;
    font-family: 'Arial', sans-serif;
}

    </style>
</head>
<body>
<div class="produto">
    <img src="container2.png.jpeg" alt="Descrição do produto">
    <h3>Container Banheiro</h3>
    <p>R$2.700,00</p>
    <button onclick="window.location.href = 'cliente.php'">Adicionar no Carrinho</button>
</div>
<div class="produto">
    <img src="container3.png.jpeg" alt="Descrição do produto">
    <h3>Almoxarifado Laranja de 2x3</h3>
    <p>R$6.000</p>
    <button onclick="window.location.href = 'cliente.php'">adicionar no Carrinho</button>
</div>
<div class="produto">
    <img src="container4.png.jpeg" alt="Descrição do produto">
    <h3>Container Lanchoenete</h3>
    <p>R$10.500,00</p>
    <button onclick="window.location.href = 'cliente.php'">adicionar no Carrinho</button>
</div>
<div class="produto">
    <img src="container5.png.jpeg" alt="Descrição do produto">
    <h3>Container Escritorio 3x2</h3>
    <p>R$5.0000,00</p>
    <button onclick="window.location.href = 'cliente.php'">adicionar no Carrinho</button>
</div>
<div class="produto">
    <img src="container10.jpg" alt="Descrição do produto">
    <h3>Container deposito verde</h3>
    <p>R$6.500,00</p>
    <button onclick="window.location.href = 'cliente.php'">adicionar no Carrinho</button>
</div>
<div class="produto">
    <img src="container11.jpg" alt="Descrição do produto">
    <h3>Container Escritorio 6x2</h3>
    <p>R$10.000,00</p>
    <button onclick="window.location.href = 'cliente.php'">adicionar no Carrinho</button>
</div>
<div class="produto">
    <img src="container9.jpg" alt="Descrição do produto">
    <h3>Biblioteca</h3>
    <p>R$15.000,00</p>
    <button onclick="window.location.href = 'cliente.php'">adicionar no Carrinho</button>
</div>
<div class="produto">
    <img src="container12.jpg" alt="Descrição do produto">
    <h3>Almoxarifado com porta lateral</h3>
    <p>R$6.500,00</p>
    <button onclick="window.location.href = 'cliente.php'">adicionar no Carrinho</button>
</div>
<div class="produto">
    <img src="container13.jpg" alt="Descrição do produto">
    <h3>Escritorio com janela</h3>
    <p>R$7.5000</p>
    <button onclick="window.location.href = 'cliente.php'">adicionar no Carrinho</button>
</div>
          <div class="rodapé">
            <p>Todos os direitos reservados © 2023</p>
         </div>
</body>
</html>
