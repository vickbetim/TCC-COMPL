<?php
include_once("conexao.php");

$pdo = conectar();

// Consulta para buscar todos os clientes
$sql = "SELECT * FROM tb_clientes";
$stm = $pdo->query($sql); $clientes = $stm->fetchAll(PDO::FETCH_ASSOC); ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clientes Cadastrados</title>
    <style>
      body {
        background-image: url("container10.jpg");
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
        max-width: 1000px;
        margin: 0 auto;
      }

      table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
      }

     
      td {
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
        color: #000;
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
      <h1>Clientes Cadastrados</h1>
      <table>
        <tr>
          <th>Código</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>Telefone</th>
          <th>Email</th>
          <th>Tipo Cliente</th>
          <th>Ativo</th>
          <th>Complemento</th>
          <th>Rua</th>
          <th>Número</th>
          <th>Bairro</th>
          <th>Ações</th>
        </tr>
        <?php foreach ($clientes as $cliente) : ?>
        <tr>
            <td><?php echo $cliente['cod_cliente']; ?></td>
            <td><?php echo $cliente['nome']; ?></td>
            <td><?php echo $cliente['cpf']; ?></td>
            <td><?php echo $cliente['telefone']; ?></td>
            <td><?php echo $cliente['gmail']; ?></td>
            <td><?php echo $cliente['tipocliente']; ?></td>
            <td><?php echo $cliente['ativo']; ?></td>
            <td><?php echo $cliente['complemento']; ?></td>
            <td><?php echo $cliente['rua']; ?></td>
            <td><?php echo $cliente['numero']; ?></td>
            <td><?php echo $cliente['bairro']; ?></td>
            <td>
                <a href="altclientes.php?id=<?php echo $cliente['cod_cliente']; ?>">Alterar</a>
                <button onclick="excluirCliente(<?php echo $cliente['cod_cliente']; ?>)">Excluir</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function excluirCliente(id) {
            if (confirm('Tem certeza de que deseja excluir este cliente?')) {
                window.location = 'exccliente.php?id=' + id;
            }
        }
    </script>
</body>
</html>