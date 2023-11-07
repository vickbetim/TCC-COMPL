<?php
//session_start();
include_once("conexao2.php");

$pdo = conectar();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Adicionar Produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="produto.css">
</head>

<body>
    <div class="tbm">
        <form method="post" enctype="multipart/form-data">
            <h2>Cadastro de Produto</h2>

            <div class="form-group"> 
                <label class= "espaço"></label>
            <select  name="ativo">
            <option>Ativo
            <option>S</option>
            <option>N</option>
            </select>
                <input type="text" name="valor" class="form-control col-6" placeholder="Digite o valor do produto">
                <input type="text" name="tamanho" class="form-control col-6" placeholder="Digite o tamanho do produto">
                <input type="text" name="descricao" class="form-control col-6" placeholder="Digite a descrição do produto">

                <button type="submit" name="btnSalvar" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</body>
</html>

<?php
//fazer o teste se foi pressionado o botão
if (isset($_POST['btnSalvar'])) {

    // receba os dados do formulário
    // faça 1 para cada input
    $ativo = $_POST['ativo'];
      $valor = $_POST['valor'];
    $tamanho = $_POST['tamanho'];
    $descricao = $_POST['descricao'];
  

    //validação simplificada - se o campo tá vazio
    if (empty($descricao)) {    
        echo "Necessário informar a descrição da produtos";
        exit();
    }

    // criar o SQL de inserção
    $sql = "INSERT INTO tb_produtos (ativo, valor, tamanho, descricao) VALUES  ( :ativo , :valor , :tamanho , :descricao)";

    // preparar o SQL para execução (EVITA SQL INJECTION)
    $stmt = $pdo->prepare($sql);

    // trocar pelo valor da variavel magica pelo recebido via formulário
    $stmt->bindParam(':ativo', $ativo);
    $stmt->bindParam(':valor', $valor);
    $stmt->bindParam(':tamanho', $tamanho);
    $stmt->bindParam(':descricao', $descricao);

    // mandar realizar o codigo 
    if ($stmt->execute()) {
        echo "Produto inserido com sucesso!";
    } else {
        die("Erro ao inserir o produto.");
    }
}
?>