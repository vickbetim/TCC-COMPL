<?php
include_once("conexao.php");

try {
    // Conecta ao banco de dados usando PDO
    $pdo = new PDO('mysql:host=localhost;dbname=c3solucoes', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}

$query = "SELECT p.*, i.imagem_produto FROM tb_produtos p
LEFT JOIN tb_imagens_produtos i ON p.cod_produto = i.cod_produto WHERE p.ativo = 'S'";

$stmt = $pdo->query($query);

if ($stmt->rowCount() > 0) {
    $counter = 0;
    echo '<div class="product-list">';
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Inicia uma nova linha após cada grupo de 3 produtos
        if ($counter % 3 === 0) {
            if ($counter > 0) {
                echo '</div>'; // Fecha a linha anterior, exceto na primeira iteração
            }
            echo '<div class="product-row">';
        }
        
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

    // Fecha a última linha, se necessário
    if ($counter % 3 !== 0) {
        echo '</div>';
    }
    
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
        /* O restante do seu CSS permanece inalterado */

        .product-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .product {
            width: calc(33.33% - 20px); /* Ajuste de largura para acomodar 3 produtos por linha */
            box-sizing: border-box;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px 0; /* Ajuste de margem para reduzir o espaço vertical entre os produtos */
            background-color: #fff;
            position: relative; /* Adicionado para posicionar o botão em relação a este contêiner */
            text-align: center;
        }

        .product img {
            width: 10rem; /* Largura de 100% para que a imagem se ajuste à largura do contêiner .product */
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

        .shopping-cart {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
        }

        /* Adicione a seguinte regra CSS para o seu rodapé (.footer) */

        .footer {
    width: 100%;
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 1rem;
    box-sizing: border-box;
}

        .logo {
            display: inline-block;
            vertical-align: middle; /* Alinha verticalmente ao meio */
        }

        .logo img {
            width: 40px;
        }

        .footer-links {
            display: inline-block;
            vertical-align: middle; /* Alinha verticalmente ao meio */
        }

        .footer-links h3 {
            font-size: 1rem;
            margin: 0;
            padding: 10px 0;
            text-align: center;
            font-family: "Courier New", Courier, monospace;
        }
    </style>
    <title>Produtos</title>
  </head>
  <body>
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