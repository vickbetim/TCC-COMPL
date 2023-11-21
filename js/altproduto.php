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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Alteração de Produto</title>
    <style>
      body {
        font-family: Arial, Helvetica, sans-serif;
        background-image: url("container7.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }

      form {
        background-color: rgba(255, 255, 255, 0.7);
        padding: 20px;
        border-radius: 12px;
        max-width: 800px;
        width: 100%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        margin: auto;
        display: flex;
        flex-wrap: wrap;
      }

      h2 {
        width: 100%;
        text-align: center;
        color: rgb(0, 0, 0);
      }

      table {
        width: 100%;
      }

      table td {
        width: 50%;
        box-sizing: border-box;
        padding: 10px;
        border: 1px solid white;
        border-radius: 6px;
      }

      label {
        display: block;
        margin-bottom: 5px;
      }

      input,
      select {
        width: calc(100% - 20px);
        padding: 10px;
        border: 1px solid #deb887;
        border-radius: 6px;
        box-sizing: border-box;
      }

      button {
        background-color: #deb887;
        border: none;
        padding: 15px;
        border-radius: 8px;
        font-size: 15px;
        cursor: pointer;
        box-shadow: 1px 1px 1px black;
        color: white;
        width: 100%;
        margin-top: 10px;
      }

      button:hover {
        background-color: deepskyblue;
      }

      p {
        font-size: 15px;
        color: rgb(0, 0, 0);
      }

      a {
        color: #000;
        text-decoration: none;
      }

      @media only screen and (max-width: 600px) {
        form {
          padding: 10px;
        }

        input,
        select {
          width: 100%;
        }

        button {
          width: 100%;
        }
      }
    </style>
  </head>
  <body>
    <form method="post">
      <h2>Alteração de Produto</h2>
      <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <label for="descricao">Descrição:</label>
      <input
        type="text"
        name="descricao"
        value="<?php echo $produto['descricao']; ?>"
      /><br />
      <label for="valor">Valor:</label>
      <input
        type="text"
        name="valor"
        value="<?php echo $produto['valor']; ?>"
      /><br />
      <label for="tamanho">Tamanho:</label>
      <input
        type="text"
        name="tamanho"
        value="<?php echo $produto['tamanho']; ?>"
      /><br />
      <label for="ativo">Ativo:</label>
      <input
        type="text"
        name="ativo"
        value="<?php echo $produto['ativo']; ?>"
      /><br />
      <input type="submit" name="btnalterar" value="Alterar" />
    </form>
  </body>
</html>
