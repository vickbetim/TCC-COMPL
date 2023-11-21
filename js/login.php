<?php
include_once 'conexao.php';
$pdo = conectar();
session_start(); // Mantenha essa chamada

if (isset($_POST['btnEnviar'])) {
    $gmail = $_POST['gmail'];
    $hash_senha = $_POST['hash_senha'];

    $sql = "SELECT * FROM tb_clientes WHERE gmail = :gmail AND hash_senha = :hash_senha";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':gmail', $gmail);
    $stmt->bindParam(':hash_senha', $hash_senha);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
        $tipocliente = $cliente['tipocliente'];

        if ($tipocliente === 'C') {
            // Se for um cliente (C), redirecione para a página do cliente
            header('Location: pagina.php');
            exit(); // Encerre a execução do script após o redirecionamento
        } elseif ($tipocliente === 'F') {
            // Se for um funcionário (F), redirecione para a página de funcionário
            header('Location: homeadm.php');
            exit();
        }
    } else {
        echo "As senhas não coincidem. Tente novamente.";
    }
}
?>
<
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <style>
      body {
        background-image: url("container7.jpg");
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        font-family: arvo;
        position: relative;
      }

      body::after {
        content: "";
        background-color: rgba(
          0,
          0,
          0,
          0.5
        ); /* Cor preta com 50% de transparência */
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1; /* Coloque esta camada atrás do conteúdo */
      }

      .container {
        text-align: center;
        position: relative;
        z-index: 1; /* Garanta que o conteúdo esteja à frente da camada preta */
        background: white; /* Define o fundo do container como branco */
        padding: 20px; /* Adiciona algum espaçamento dentro do container */
        border-radius: 10px; /* Arredonda as bordas do container */
      }

      .input-container {
        position: relative;
        margin: 20px 10px;
      }

      .input-container input {
        font-family: "Poppins-SemiBold", sans-serif;
        font-size: 18px;
        color: #555;
        line-height: 1.2;
        display: block;
        width: 100%;
        height: 52px;
        background: 0 0;
        padding: 0 5px;
        border: none;
        border-bottom: 2px solid #000;
        outline: none;
      }

      .input-container label {
        position: absolute;
        top: 0;
        left: 0;
        transition: all 0.2s;
        pointer-events: none;
        font-family: "Poppins-Bold", sans-serif;
      }

      .input-container input:focus + label,
      .input-container input:valid + label {
        font-size: 14px;
        transform: translateY(-20px);
      }

      .button-container {
        margin: 10px;
      }

      .button-container button {
        background-color: #007bff;
        color: #fff;
        padding: 15px 150px;
        font-size: 18px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
        border-radius: 50px;
      }

      .button-container button:hover {
        background-color: #696969;
      }

      .button-container p {
        margin-top: 10px;
        font-size: 16px;
      }

      /* Estilize o texto "Bem-vindo" fora do container */
      .welcome-text {
        color: white; /* Define a cor do texto "Bem-vindo" como branca */
        font-size: 24px; /* Tamanho da fonte desejado */
        position: absolute;
        top: 60px; /* Ajuste o valor para mover a palavra "Bem-vindo" para baixo */
        left: 50%;
        transform: translateX(-50%);
      }
    </style>
  </head>
  <body>
    <div class="welcome-text">
      <h1>Bem-vindo</h1>
    </div>

    <div class="container">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="input-container">
          <input type="gmail" id="gmail" name="gmail" required />
          <label for="gmail">Gmail</label>
        </div>
        <div class="input-container">
          <input type="password" id="hash_senha" name="hash_senha" required />
          <label for="hash_senha">Senha</label>
        </div>
        <div class="button-container">
          <button type="submit" name="btnEnviar">Login</button>
          <p>Esqueceu senha? <a href="altsenha.php">Redefinir senha</a></p>
          <p>
          <p>Ainda não tem uma Conta?<a href="cliente.php">Cadastre-se</a></p>
          <p>
          </p>
        </div>
      </form>
    </div>
  </body>
</html>
