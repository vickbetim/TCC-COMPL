<?php
include_once("conexao.php");

$pdo = conectar();

$cliente = array(
    'cod_cliente' => '',
    'cod_cidade' => '',
    'nome' => '',
    'telefone' => '',
    'gmail' => '',
    'cpf' => '',
    'tipocliente' => '',
    'ativo' => '',
    'complemento' => '',
    'rua' => '',
    'numero' => '',
    'bairro' => '',
    'hash_senha' => ''
);

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_clientes WHERE cod_cliente = :id";

    $stm = $pdo->prepare($sql);
    $stm->bindParam(':id', $id);
    $stm->execute();

    $cliente = $stm->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        echo "Cliente não encontrado.";
        exit();
    }
}

if (isset($_POST['btnalterar'])) {
    // Recupere os valores do formulário
    $cod_cidade = $_POST['cod_cidade'];
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $gmail = $_POST['gmail'];
    $cpf = $_POST['cpf'];
    $tipocliente = $_POST['tipocliente'];
    $ativo = $_POST['ativo'];
    $complemento = $_POST['complemento'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $hash_senha = $_POST['hash_senha'];

     // Gere uma senha aleatória ou receba a senha do usuário por meio de um formulário
     $senhaUsuario = $_POST['hash_senha'];

     // Use a função password_hash para criar um hash seguro da senha
     $senhaCriptografada = password_hash($senhaUsuario, PASSWORD_DEFAULT);
    // Atualize os valores no banco de dados
    $sqlup = "UPDATE tb_clientes SET cod_cidade = :cod_cidade, nome = :nome, telefone = :telefone, gmail = :gmail, cpf = :cpf, tipocliente = :tipocliente, ativo = :ativo, complemento = :complemento, rua = :rua, numero = :numero, bairro = :bairro, hash_senha = :hash_senha WHERE cod_cliente = :id";

    $stmup = $pdo->prepare($sqlup);

    $stmup->bindParam(':cod_cidade', $cod_cidade);
    $stmup->bindParam(':nome', $nome);
    $stmup->bindParam(':telefone', $telefone);
    $stmup->bindParam(':gmail', $gmail);
    $stmup->bindParam(':cpf', $cpf);
    $stmup->bindParam(':tipocliente', $tipocliente);
    $stmup->bindParam(':ativo', $ativo);
    $stmup->bindParam(':complemento', $complemento);
    $stmup->bindParam(':rua', $rua);
    $stmup->bindParam(':numero', $numero);
    $stmup->bindParam(':bairro', $bairro);
    $stmup->bindParam(':hash_senha',  $senhaCriptografada);
    $stmup->bindParam(':id', $id);

    if ($stmup->execute()) {
        echo "Dados do cliente alterados com sucesso!";
        header("Location: listacli.php");
    } else {
        echo "Erro ao realizar a alteração.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Alteração de Cliente</title>
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
        max-width: 800px; /* Aumente a largura máxima para acomodar duas colunas */
        width: 100%;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        margin: auto; /* Centralize o formulário */
        display: flex;
        flex-wrap: wrap; /* Permita que os elementos quebrem para a próxima linha quando não couberem */
      }

      h1 {
        width: 100%; /* Garanta que o título ocupe a largura total da linha */
        text-align: center;
        color: rgb(0, 0, 0);
      }

      table {
        width: 100%;
      }

      table td {
        width: 50%; /* Cada célula ocupa 50% da largura */
        box-sizing: border-box; /* Inclua padding e borda na largura da célula */
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
        width: calc(
          100% - 20px
        ); /* Leve em consideração o padding ao definir a largura */
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
        margin-top: 10px; /* Adicione um espaço entre os campos e o botão */
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

      /* Responsive layout for smaller screens */
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
    <div class="box">
      <form method="post">
        <h1>Alteração de Cliente</h1>
        <table>
          <tr>
            <td>
              <label for="nome">Nome:</label>
              <input
                type="text"
                name="nome"
                value="<?php echo $cliente['nome']; ?>"
              />
            </td>
            <td>
              <label for="cpf">CPF:</label>
              <input
                type="text"
                maxlength="11"
                name="cpf"
                value="<?php echo $cliente['cpf']; ?>"
              />
            </td>
          </tr>
          <tr>
            <td>
              <label for="telefone">Telefone:</label>
              <input
                type="text"
                name="telefone"
                value="<?php echo $cliente['telefone']; ?>"
              />
            </td>
            <td>
              <label for="gmail">Email:</label>
              <input
                type="text"
                name="gmail"
                value="<?php echo $cliente['gmail']; ?>"
              />
            </td>
          </tr>
          <tr>
            <td>
              <label for="ativo">Ativo:</label>
              <input
                type="text"
                name="ativo"
                value="<?php echo $cliente['ativo']; ?>"
              />
            </td>
            <td>
              <label for="complemento">Complemento:</label>
              <input
                type="text"
                name="complemento"
                value="<?php echo $cliente['complemento']; ?>"
              />
            </td>
          </tr>
          <tr>
            <td>
              <label for="rua">Rua:</label>
              <input
                type="text"
                name="rua"
                value="<?php echo $cliente['rua']; ?>"
              />
            </td>
            <td>
              <label for="numero">Número:</label>
              <input
                type="text"
                name="numero"
                value="<?php echo $cliente['numero']; ?>"
              />
            </td>
          </tr>
          <tr>
            <td>
              <label for="bairro">Bairro:</label>
              <input
                type="text"
                name="bairro"
                value="<?php echo $cliente['bairro']; ?>"
              />
            </td>
            <td>
              <label for="hash_senha">Senha:</label>
              <input
                type="text"
                name="hash_senha"
                value="<?php echo $cliente['hash_senha']; ?>"
              />
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <button type="submit" name="btnalterar">Alterar</button>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </body>
</html>