<?php
include_once 'conexao.php'; // Inclua o arquivo de conexão com o banco de dados

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    // Recupere os dados do formulário
    // cod_produto INT AUTO_INCREMENT PRIMARY KEY,
// ativo VARCHAR(1) CHECK (ativo IN ('S', 'N')),
// valor FLOAT(5,2),
// tamanho INT,
// descricao 
    $ativo = $_POST['ativo'];
    $valor = $_POST['valor'];
    $tamanho = $_POST['tamanho'];
    $descricao = $_POST['descricao'];

    // Validação básica (você pode adicionar mais validações conforme necessário)
    if (empty($ativo) || empty($valor) || empty($tamanho) || empty($descricao)) {
        echo 'Todos os campos são obrigatórios.';
    } else 
        // Insira os dados no banco de dados
        $pdo = conectar();

        $sql = "INSERT INTO tb_produtos (ativo, valor, descricao, tamanho) VALUES ( :ativo, :valor, :descricao, :tamanho)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':ativo', $ativo);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':tamanho', $tamanho);
        $stmt->bindValue(':valor', $valor);


      
    
        if ($stmt->execute()) {
            echo 'Produto adicionado com sucesso.';
        } else {
            echo 'Erro ao adicionar o produto.';
        }
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
</head>
<body>
    <h2>Adicionar Produto</h2>
    
    <!-- Formulário de adição de produto -->
    <form action="add_produto.php" method="post">
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" required>
        
        <label for="tamanho">Estoque:</label>
        <input type="number" name="tamanho" required>
        
        <label for="valor">Preço:</label>
        <input type="number" name="valor" step="0.01" required>
        
        <input type="submit" value="Adicionar Produto">
    </form>

    <br>

    <a href="carr.php">Voltar para o Carrinho</a>
</body>
</html>
