<?php
// Include your database connection code (conexao.php) here
include_once("conexao.php");

// Establish a database connection
$pdo = conectar();

$produto = array('descricao' => '', 'valor' => '', 'tamanho' => '', 'ativo' => '');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_produtos WHERE cod_produto = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$produto) {
        echo "Produto não encontrado.";
        exit();
    }
}

// Process the form submission
if (isset($_POST['btnalterar'])) {
    $descricao = $_POST['descricao'];
    $valor = $_POST['valor'];
    $tamanho = $_POST['tamanho'];
    $ativo = $_POST['ativo'];

    if (empty($descricao) || empty($valor) || empty($tamanho) || empty($ativo)) {
        echo "Necessário preencher todos os campos!";
    } else {
        $sql = "UPDATE tb_produtos SET descricao = :descricao, valor = :valor, tamanho = :tamanho, ativo = :ativo WHERE cod_produto = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':tamanho', $tamanho);
        $stmt->bindParam(':ativo', $ativo);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "Produto alterado com sucesso!";
            echo '<script>history.go(-2);</script>'; 
            exit(); 
        } else {
            echo "Erro ao realizar a alteração do produto.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Produto</title>
    <style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #ec56;
        display: block;
        justify-content: center;
        align-items: center;
        height: 80vh;
        margin: 0;
    }

    table {
        border-collapse: collapse;
        width: 400px;
        background-color: rgb(70, 70, 70);
        padding: 12px;
        border-radius: 14px;
        border: 2px ridge white;
        color: white;
        margin: 0 auto; /* Centraliza horizontalmente */
    }
/* 
    th, td {
        border: 3px ;
        padding: 8px;
    } */

    a {
        text-decoration: none;
        color: dodgerblue;
    }

    h2 {
        text-align: center;
    }

    button {
        background-color: dodgerblue;
        border: none;
        padding: 15px;
        width: 100%;
        border-radius: 8px;
        font-size: 15px;
        cursor: pointer;
        box-shadow: 1px 1px 1px black;
        color: white;
    }

    button:hover {
        background-color: deepskyblue;
    }

    form {
        text-align: center;
    }

    label {
        display: inline;
        margin-top: 5px;
    }

    input {
        width: 40%;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid grey;
    }
</style>



</head>
<body>
    <h2>Alteração de Produto</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" value="<?php echo $produto['descricao']; ?>"><br>
        <label for="valor">Valor:</label>
        <input type="text" name="valor" value="<?php echo $produto['valor']; ?>"><br>
        <label for="tamanho">Tamanho:</label>
        <input type="text" name="tamanho" value="<?php echo $produto['tamanho']; ?>"><br>
        <label for="ativo">Ativo:</label>
        <input type="text" name="ativo" value="<?php echo $produto['ativo']; ?>"><br>
        <input type="submit" name="btnalterar" value="Alterar">
    </form>
</body>
</html>
