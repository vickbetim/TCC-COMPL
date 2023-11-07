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
    'senha' => ''
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
    $senha = $_POST['senha'];

    // Atualize os valores no banco de dados
    $sqlup = "UPDATE tb_clientes SET cod_cidade = :cod_cidade, nome = :nome, telefone = :telefone, gmail = :gmail, cpf = :cpf, tipocliente = :tipocliente, ativo = :ativo, complemento = :complemento, rua = :rua, numero = :numero, bairro = :bairro, senha = :senha WHERE cod_cliente = :id";

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
    $stmup->bindParam(':senha', $senha);
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Cliente</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: black;
        }
        table th, td {
            border: 1px solid grey;
        }
        .box {
            position: absolute;
            top: 15%;
            left: 35%;
            background-color: rgb(70, 70, 70);
            padding: 12px;
            border-radius: 14px;
            border: 2px ridge white;
            width: 400px;
            color: white;
        }
        a {
            text-decoration: none;
            color: dodgerblue;
        }
        h1 {
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
        form input {
            display: flex;
            float: right;
        }
    </style>
</head>
<body>
    <div class="box">
        <form method="post">
            <h1>Alteração</h1>
            <table>
                <ul>
                    <li>Nome: <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>"></li>
                    <br>
                    <li>CPF: <input type="text" maxlength="11" name="cpf" value="<?php echo $cliente['cpf']; ?>"></li>
                    <br>
                    <li>Telefone: <input type="text" name="telefone" value="<?php echo $cliente['telefone']; ?>"></li>
                    <br>
                    <li>Email: <input type="text" name="gmail" value="<?php echo $cliente['gmail']; ?>"></li>
                    <br>
                    <li>Ativo: <input type="text" name="ativo" value="<?php echo $cliente['ativo']; ?>"></li>
                    <br>
                    <li>Complemento: <input type="text" name="complemento" value="<?php echo $cliente['complemento']; ?>"></li>
                    <br>
                    <li>Rua: <input type="text" name="rua" value="<?php echo $cliente['rua']; ?>"></li>
                    <br>
                    <li>Número: <input type="text" name="numero" value="<?php echo $cliente['numero']; ?>"></li>
                    <br>
                    <li>Bairro: <input type="text" name="bairro" value="<?php echo $cliente['bairro']; ?>"></li>
                    <br>
                    <li>Senha: <input type="text" name="senha" value="<?php echo $cliente['senha']; ?>"></li>
                    <br>
                    <button type="submit" name="btnalterar">Alterar</button>
                </ul>
            </table>
        </form>
    </div>
</body>
</html>
