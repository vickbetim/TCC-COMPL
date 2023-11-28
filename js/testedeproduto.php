<?php
include_once("conexao.php");

try {
    // Conecta ao banco de dados usando PDO
    $pdo = new PDO('mysql:host=localhost;dbname=c3solucoes', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}

// Lógica de pesquisa
if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['pesquisa']) && !empty($_GET['pesquisa'])) {
        $pesquisa = $_GET['pesquisa'] . "%";
        $query = "SELECT p.*, i.imagem_produto FROM tb_produtos p
                  LEFT JOIN tb_imagens_produtos i ON p.cod_produto = i.cod_produto 
                  WHERE p.descricao LIKE :pesquisa AND p.ativo = 'S'";
        
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":pesquisa", $pesquisa);
        $stmt->execute();
    } else {
        // Se nenhum termo de pesquisa fornecido, execute a consulta padrão
        $query = "SELECT p.*, i.imagem_produto FROM tb_produtos p
                  LEFT JOIN tb_imagens_produtos i ON p.cod_produto = i.cod_produto 
                  WHERE p.ativo = 'S'";
        
        $stmt = $pdo->query($query);
    }
} else {
    // Se não for uma solicitação GET, execute a consulta padrão
    $query = "SELECT p.*, i.imagem_produto FROM tb_produtos p
              LEFT JOIN tb_imagens_produtos i ON p.cod_produto = i.cod_produto 
              WHERE p.ativo = 'S'";
    
    $stmt = $pdo->query($query);
}

if ($stmt->rowCount() > 0) {
    $counter = 0;
    echo '<div class="product-list" style="margin-top: 1cm; margin-bottom: 1cm;">'; // Adiciona margem superior e inferior
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Check if a new row should be started
        if ($counter % 3 === 0) {
            // Close the previous row if not the first row
            if ($counter > 0) {
                echo '</div>';
            }
            // Open a new row
            echo '<div class="product-row">';
        }
        // Restante do código para exibir os produtos...
        echo '<div class="product">';
        echo '<img src="imagens/' . $row['imagem_produto'] . '" alt="Imagem do Produto" />';
        // Descrição, tamanho e valor do produto
        echo '<div class="product-info">';
        echo '<p class="product-description">' . $row['descricao'] . '</p>';
        echo '<p>Tamanho: ' . $row['tamanho'] . '</p>';
        echo '<p>Valor: R$' . number_format($row['valor'], 2) . '</p>';
        echo '</div>';
        // Botão "Adicionar ao Carrinho"
        echo '<form method="post" action="addproduto.php">';
        echo '<input type="hidden" name="cod_produto" value="' . $row['cod_produto'] . '">';
        echo '<input type="submit" value="Adicionar ao Carrinho">';
        echo '</form>';
        echo '</div>'; // Fecha o contêiner .product
        
        // Incrementa o contador
        $counter++;
    }

    // Close the last row
    echo '</div>';
    echo '</div>'; // Fecha a última linha
} else {
    echo 'Nenhum produto disponível.';
}
?>




  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <style>
        * {
          margin: 0;
          padding: 0;
          font-family: sans-serif;
          box-sizing: border-box;
        }

        .header.fixed-header {
          position: fixed;
          top: 0;
          width: 100%;
          z-index: 1000;
          background-color: #333;
        }

        nav {
          background-color: black;
          display: flex;
          align-items: center;
          justify-content: space-between;
          padding: 10px;
        }

        nav a {
          color: white;
          margin-right: 20px;
        }

        /* Estilos adicionados para centralizar a logomarca no meio do cabeçalho */
        .logo-image {
          max-width: 50px;
        }

        /* Remova ou ajuste esta regra para a logo padrão */
        .logo img {
          width: 40px;
        }

        .navigation {
          list-style-type: none;
          display: flex;
          align-items: center;
          margin: 0;
          padding: 0;
        }

        .navigation li {
          font-size: 20px;
        }

        .navigation ul {
          display: flex;
          align-items: center;
          margin: 0;
          padding: 0;
        }

        .navigation a {
          text-decoration: none;
          font-size: 22px;
          padding: 20px;
          transition: 0.2s ease-in;
          color: white;
          margin-right: 10px !important;
        }

        form {
          display: flex;
          align-items: center;
          margin-left: auto;
          margin-right: 20px;
        }

        input[type="text"] {
          padding: 10px;
          border: none;
          border-radius: 25px;
          margin-right: 10px;
        }

        button {
          background: none;
          border: none;
          cursor: pointer;
          padding: 10px;
          border-radius: 100%;
          background-color: #ccc;
        }

        button img {
          width: 20px;
          height: auto;
          border-radius: 50%;
        }

        .product-row {
          display: flex;
          justify-content: space-between;
          margin-bottom: 20px;
        }

        .product {
          width: calc(33.33% - 20px);
          box-sizing: border-box;
          border: 1px solid #ccc;
          padding: 10px;
          margin: 10px 0;
          background-color: #fff;
          position: relative;
          text-align: center;
        }

        .product img {
          width: 10rem;
          height: auto;
        }

        .product-info {
          margin-top: 10px;
        }

        .product-description {
          font-weight: bold;
          margin-bottom: 5px;
        }

        .button-container {
          margin-top: 10px;
        }

        .product a {
          display: inline-block;
          background-color: #333;
          color: #fff;
          text-decoration: none;
          padding: 5px 10px;
        }
        .product:hover {
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
  transform: translateY(-5px);
  transition: box-shadow 0.3s ease, transform 0.3s ease;
}

.product:hover img {
  filter: brightness(80%);
}

        .shopping-cart {
          max-width: 800px;
          margin: 0 auto;
          padding: 20px;
          background-color: #fff;
          border: 1px solid #ccc;
        }

        .footer {
  width: 100%;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 1rem;
  box-sizing: border-box;
  /* Remova a propriedade position: fixed; */
  /* bottom: 0; */
}

        .logo {
          display: inline-block;
          vertical-align: middle;
        }

        .logo img {
          width: 40px;
        }

        .footer-links {
          display: inline-block;
          vertical-align: middle;
        }

        .footer-links h3 {
          font-size: 1rem;
          margin: 0;
          padding: 10px 0;
          text-align: center;
          font-family: "Courier New", Courier, monospace;
        }
        /* Estilizando o botão "Adicionar ao Carrinho" */
.product input[type="submit"] {
  background-color: #000; /* Cor de fundo do botão */
  color: #fff; /* Cor do texto do botão */
  padding: 10px 20px; /* Espaçamento interno do botão */
  border: none; /* Remover a borda do botão */
  border-radius: 5px; /* Cantos arredondados do botão */
  cursor: pointer;
  transition: background-color 0.3s ease, color 0.3s ease; /* Efeito de transição suave */
}

.product input[type="submit"]:hover {
  background-color: #333; /* Cor de fundo do botão ao passar o cursor */
}

.product input[type="submit"]:active {
  background-color: #777; /* Cor de fundo do botão ao ser pressionado */
}

      </style>
      <title>Produtos</title>
    </head>
    <body>
      <header class="header fixed-header">
        <nav>
          <a>(45)3442-1642|c3solucao@gmail.com</a>
          <form method="get" action="">
            <img src="logo2.png" alt="" class="logo-image" />
            <ul class="navigation">
              <li><a href="pagina.php">Inicio</a></li>
            </ul>
            <input
              type="text"
              name="pesquisa"
              placeholder="Pesquisar produtos"
            />
            <button type="submit">
              <img src="lupa.png" alt="Ícone de Lupa" />
            </button>
          </form>
        </nav>
      </header>

      <footer class="footer">
        <div class="footer-content">
          <div class="logo">
            <img src="logo2.png" alt="Logo da Empresa" />
          </div>
          <div class="footer-links">
            <h3>©️ Daniela e Victoria 2023. Todos Os Direitos Reservados.</h3>
          </div>
        </div>
      </footer>
    </body>
  </html>
</div>