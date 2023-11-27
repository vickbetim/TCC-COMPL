<?php
include_once 'conexao.php';
$pdo = conectar();
session_start(); // Mantenha essa chamada

if (isset($_POST['btnAlterarSenha'])) {
    $gmail = $_POST['gmail'];
    $nova_senha = $_POST['nova_senha'];
    $confirma_senha = $_POST['confirma_senha'];

    // Validar se as senhas coincidem
    if ($nova_senha !== $confirma_senha) {
        echo "As novas senhas não coincidem. Tente novamente.";
        exit();

    }else{
        
        // Senha atual correta, atualizar a senha no banco de dados
        $nova_hash_senha = password_hash($nova_senha, PASSWORD_DEFAULT);

        $sql_alterar_senha = "UPDATE tb_clientes SET hash_senha = :nova_hash_senha WHERE gmail = :gmail";
        $stmt_alterar_senha = $pdo->prepare($sql_alterar_senha);
        $stmt_alterar_senha->bindParam(':nova_hash_senha', $nova_hash_senha);
        $stmt_alterar_senha->bindParam(':gmail', $gmail);
        $stmt_alterar_senha->execute();

        echo "Senha alterada com sucesso!";
    
        }
        
    }



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <!-- Adicione o seu CSS ou use o mesmo estilo da página de login -->
    <title>Alterar Senha</title>
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
                <input type="password" id="confirma_senha" name="confirma_senha" required />
                <label for="confirma_senha">Confirme a Nova Senha</label>
            </div>
            <div class="button-container">
                <button type="submit" name="btnAlterarSenha">Alterar Senha</button>
            </div>
        </form>
    </div>
</body>
</html>