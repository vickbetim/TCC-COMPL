<?php
include_once 'conexao.php';
$pdo = conectar();

if (isset($_POST['btnRedefinir'])) {
    $novaSenha = $_POST['nova_senha'];
    $confirmarSenha = $_POST['confirmar_senha'];
    $gmail = $_POST['gmail'];

    // Verifique se as senhas coincidem
    if ($novaSenha == $confirmarSenha) {
        // Hash da nova senha
        $hashNovaSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Atualize a senha no banco de dados
        $sql = "UPDATE tb_clientes SET hash_senha = :hash_senha WHERE gmail = :gmail";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':hash_senha', $hashNovaSenha);
        $stmt->bindParam(':gmail', $gmail);
        $stmt->execute();

        echo "Senha alterada com sucesso!";
    } else {
        echo "As senhas não coincidem. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <!-- Adicione as mesmas tags head que você usou em seu arquivo original -->
  </head>
  <body>
    <div class="container">
      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="input-container">
          <input type="gmail" id="gmail" name="gmail" required />
          <label for="gmail">Gmail</label>
        </div>
        <div class="input-container">
          <input type="password" id="nova_senha" name="nova_senha" required />
          <label for="nova_senha">Nova Senha</label>
        </div>
        <div class="input-container">
          <input type="password" id="confirmar_senha" name="confirmar_senha" required />
          <label for="confirmar_senha">Confirmar Senha</label>
        </div>
        <div class="button-container">
          <button type="submit" name="btnRedefinir">Redefinir Senha</button>
        </div>
        <div class="button-container">
            <a href="login.php">
                <button type="button">Voltar ao Login</button>
            </a>
        </div>
      </form>
    </div>
  </body>
</html>
