<!DOCTYPE html>
<html>
<head>
    <title>Produtos para Comprar</title>
</head>
<body>
    <h1>Produtos para Comprar</h1>

    <?php
    // Conexão com o banco de dados (substitua com suas credenciais)
    $servername = "seu_servidor";
    $username = "seu_usuario";
    $password = "sua_senha";
    $dbname = "sua_base_de_dados";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Consulta para obter produtos ativos
        $stmt = $conn->prepare("SELECT * FROM tb_produtos WHERE ativo = 'S'");
        $stmt->execute();

        // Exibir produtos
        if ($stmt->rowCount() > 0) {
            echo "<ul>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>";
                echo "<strong>Produto: </strong>" . $row['descricao'] . "<br>";
                echo "<strong>Valor: </strong>R$ " . number_format($row['valor'], 2, ',', '.') . "<br>";
                echo "<strong>Tamanho: </strong>" . $row['tamanho'] . "<br>";
                echo "<a href='comprar.php?cod_produto=" . $row['cod_produto'] . "'>Comprar</a>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "Nenhum produto disponível para compra no momento.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }

    $conn = null;
    ?>
</body>
</html>
