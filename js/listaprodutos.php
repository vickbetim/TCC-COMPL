<?php
include_once("conexao.php");

$pdo = conectar();

$sql = "SELECT * FROM tb_produtos";
$stmt = $pdo->prepare($sql); $stmt->execute(); $produtos =
$stmt->fetchAll(PDO::FETCH_ASSOC); ?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Produtos Cadastrados</title>
    <style>
      body {
        background-image: url("container9.jpg");
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: monospace;
        position: relative;
      }

      body::after {
        content: "";
        background-color: rgba(255, 255, 255, 0.5);
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
      }

      .content-container {
        text-align: center;
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        width: 80%;
        max-width: 800px;
        margin: 0 auto;
      }

      table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
      }

      td,
      th {
        border: 1px solid grey;
        padding: 8px;
        text-align: center;
      }

      th {
        background-color: #eaeaae;
        color: black;
      }

      a {
        text-decoration: none;
        color: black;
      }

      button {
        background-color: red;
        border: none;
        color: white;
        padding: 5px 10px;
        cursor: pointer;
      }
    </style>
  </head>
  <body>
    <div class="content-container">
      <h1>Produtos Cadastrados</h1>
      <table>
        <tr>
          <th>ID</th>
          <th>Descrição</th>
          <th>Valor</th>
          <th>Tamanho</th>
          <th>Ativo</th>
          <th>Ações</th>
        </tr>
        <?php foreach ($produtos as $produto) { ?>
        <tr>
          <td><?php echo $produto['cod_produto']; ?></td>
          <td><?php echo $produto['descricao']; ?></td>
          <td><?php echo $produto['valor']; ?></td>
          <td><?php echo $produto['tamanho']; ?></td>
          <td><?php echo $produto['ativo']; ?></td>
          <td>
            <a href="altproduto.php?id=<?php echo $produto['cod_produto']; ?>"
              >Alterar</a
            >
            <a
              href="excluirproduto.php?id=<?php echo $produto['cod_produto']; ?>"
              >Excluir</a
            >
          </td>
        </tr>
        <?php } ?>
      </table>
    </div>
  </body>
</html>