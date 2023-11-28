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
    'hash_senha
    ' => '',
    

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
    $hash_senha
     = $_POST['hash_senha
    '];
    $cod_cidade = $_POST['cod_cidade'];

    // Atualize os valores no banco de dados
    $sql = "INSERT INTO tb_clientes (nome, telefone, gmail, cpf, tipocliente, ativo, complemento, rua, numero, bairro, hash_senha
    , cod_cidade) VALUES (:nome, :telefone, :gmail, :cpf, :tipocliente, :ativo, :complemento, :rua, :numero, :bairro, :hash_senha
    , :cod_cidade)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':gmail', $gmail);
            $stmt->bindParam(':cpf', $cpf);
            $stmt->bindParam(':tipocliente', $tipocliente);
            $stmt->bindParam(':ativo', $ativo);
            $stmt->bindParam(':complemento', $complemento);
            $stmt->bindParam(':rua', $rua);
            $stmt->bindParam(':numero', $numero);
            $stmt->bindParam(':bairro', $bairro);
            $stmt->bindParam(':hash_senha
            ', $hash_senha
        );
            $stmt->bindParam(':cod_cidade', $cod_cidade);

    if ($stmup->execute()) {
        echo "Dados do cliente alterados com sucesso!";
        header("Location: cliente.php");
    } else {
        echo "Erro ao realizar a alteração.";
    }
}
?>
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
            font-family: "arvo";
            position: relative;
        }

        body::after {
            content: "";
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
        }

        .container {
            text-align: center;
            position: relative;
            z-index: 1;
            background: white;
            padding: 10px;
            border-radius: 10px;
            width: 70%;
            max-width: 400px;
            margin: 0 auto;
        }

        .input-container {
            position: relative;
            margin: 10px;
            width: calc(50% - 20px);
            display: inline-block;
        }

        .input-container input {
            font-family: "Poppins-SemiBold", sans-serif;
            font-size: 18px;
            color: #555;
            line-height: 1.2;
            display: block;
            width: 100%;
            height: 30px;
            background: 0 0;
            padding: 0 5px;
            border: none;
            border-bottom: 1px solid #000;
            outline: none;
            margin-top: 5px;
        }

        .input-container label {
            position: absolute;
            top: 10px;
            left: 5px;
            transition: all 0.2s;
            pointer-events: none;
            font-family: "Poppins-Bold", sans-serif;
        }

        .input-container input:focus + label,
        .input-container input:valid + label {
            font-size: 14px;
            transform: translateY(-20px);
        }

        h2 {
            color: #000;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .input-pair {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 150px;
            font-size: 18px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 50px;
        }

        input[type="submit"]:hover {
            background-color: #696969;
        }

        .input-pair select {
            width: 100%;
            padding: 10px;
            background-color: #fff;
            border: none;
            color: #000;
            margin-bottom: 10px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url('sua-seta-personalizada.png');
            background-position: 95% center;
            background-repeat: no-repeat;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST">
            <h2>CADASTRO</h2>
            <div class="input-pair">
                <div class="input-container">
                    <input type="text" name="nome" required>
                    <label for="nome">Nome</label>
                </div>
                <div class="input-container">
                    <input type="text" name="telefone" id="telefone" maxlength="14" oninput="formatarTelefone(this)" required>
                    <label for="telefone">Telefone</label>
                </div>
            </div>
            <div class="input-pair">
                <div class="input-container">
                    <input type="text" name="gmail" required>
                    <label for="gmail">Gmail</label>
                </div>
                <div class="input-container">
                    <input type="text" name="cpf" id="cpf" maxlength="11" oninput="formatarCPF(this)" required>
                    <label for="cpf">CPF</label>
                </div>
            </div>
            <div class="input-pair">
                <div class="input-container">
                    <input class="teste" type="text" name="complemento" required>
                    <label for="complemento">Complemento</label>
                </div>
                <div class="input-container">
                    <input class="teste" type="text" name="rua" required>
                    <label for="rua">Rua</label>
                </div>
            </div>
            <div class="input-pair">
                <div class="input-container">
                    <input type="text" name="numero" required>
                    <label for="numero">Número</label>
                </div>
                <div class="input-container">
                    <input type="text" name="bairro" required>
                    <label for="bairro">Bairro</label>
                </div>
            </div>
            <div class="input-pair">
                <div class="input-container">
                    <input type="password" name="hash_senha
                    " required>
                    <label for="hash_senha
                    ">Senha</label>
                </div>
                <div class="input-container">
                    <input type="text" name="estado" value="PR" readonly>
                    <label for="estado"></label>
                </div>
            
            </div>
            <div class="input-pair">
                <div class="input-container">
                    <select name="tipocliente" required>
                        <option value="">Selecione o Tipo de Cliente</option>
                        <option value="C">C</option>
                        <option value="F">F</option>
                    </select>
                </div>
                <div class="input-container">
                    <select name="ativo" required>
                        <option value="">Selecione o Ativo</option>
                        <option value="S">S</option>
                        <option value="N">N</option>
                    </select>
                </div>
            </div>
            <div class="input-pair">
                <select name="cod_cidade" required>
                    <option>Selecione sua cidade</option>
                    <?php foreach ($dados as $d) {
                        echo "<option value='{$d['cod_cidade']}'>{$d['nome_cidade']}</option>";
                    }
                    ?>
                </select>
            </div>
            <script>
                function formatarTelefone(input) {
                    input.value = input.value.replace(/\D/g, "");
                    const value = input.value;
                    if (value.length >= 2) {
                        input.value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
                    }
                }
                function formatarCPF(input) {
                    input.value = input.value.replace(/\D/g, "");
                    const value = input.value;
                    if (value.length >= 3) {
                        input.value = `${value.slice(0, 3)}.${value.slice(3)}`;
                    }
                    if (value.length >= 7) {
                        input.value = `${value.slice(0, 7)}.${value.slice(7)}`;
                    }
                    if (value.length >= 11) {
                        input.value = `${value.slice(0, 11)}-${value.slice(11)}`;
                    }
                }
            </script>
            <input type="submit" name="btnSalvar" value="Cadastrar">
        </form>
        <p>
            Já tem uma conta? <a href="login.html">Entrar</a>
        </p>
    </div>
</body>
</html>
