<?php
include_once "conexao.php";

$pdo = conectar();

// cidades
$sqlc = "SELECT * FROM tb_cidades";
$stmtc = $pdo->prepare($sqlc);
$stmtc->execute();
$dados = $stmtc->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['btnSalvar'])) {
    // Receive the values from the inputs
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $gmail = $_POST['gmail'];
    $cpf = $_POST['cpf'];

    // Initialize variables to check if data exists
    $gmailExists = false;
    $cpfExists = false;

    // Check if the Gmail already exists
    $sqlCheckGmail = "SELECT * FROM tb_clientes WHERE gmail = :gmail";
    $stmtCheckGmail = $pdo->prepare($sqlCheckGmail);
    $stmtCheckGmail->bindParam(':gmail', $gmail);
    $stmtCheckGmail->execute();
    
    if ($stmtCheckGmail) {
        $gmailExists = $stmtCheckGmail->rowCount() > 0;
    } else {
        echo "Error in Gmail check query";
    }

    // Check if the CPF already exists
    $sqlCheckCPF = "SELECT * FROM tb_clientes WHERE cpf = :cpf";
    $stmtCheckCPF = $pdo->prepare($sqlCheckCPF);
    $stmtCheckCPF->bindParam(':cpf', $cpf);
    $stmtCheckCPF->execute();

    if ($stmtCheckCPF) {
        $cpfExists = $stmtCheckCPF->rowCount() > 0;
    } else {
        echo "Error in CPF check query";
    }

    // Check if either Gmail or CPF already exists
    if ($gmailExists) {
        echo "O Gmail já está em uso. Por favor, escolha outro.";
    } elseif ($cpfExists) {
        echo "O CPF já está em uso. Por favor, escolha outro.";
    } else {
        // Continue with your logic for inserting data into the database
        $complemento = $_POST['complemento'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $hash_senha = password_hash($_POST['hash_senha'], PASSWORD_DEFAULT);
        $estado = $_POST['estado'];
        $cod_cidade = $_POST['cod_cidade'];

        $tipocliente = 'C';
        $ativo = 'S';

        if (empty($_POST['nome']) || empty($_POST['gmail']) || empty($_POST['hash_senha'])) {
            echo "Preencha todos os campos";
        } else {
            $sql = "INSERT INTO tb_clientes (nome, telefone, gmail, cpf, tipocliente, ativo, complemento, rua, numero, bairro, hash_senha, cod_cidade) VALUES (:nome, :telefone, :gmail, :cpf, :tipocliente, :ativo, :complemento, :rua, :numero, :bairro, :hash_senha, :cod_cidade)";
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
            $stmt->bindParam(':hash_senha', $hash_senha);
            $stmt->bindParam(':cod_cidade', $cod_cidade);

            if ($stmt->execute()) {
                // Registration is successful, redirect to "pagina.php"
                header("Location: pagina.php");
                exit();
            } 
           
else {
                echo "Erro ao cadastrar o cliente";
            }
        }
    }
}
?>

        <!DOCTYPE html>
        <html lang="ptBR">
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
            position: absolute;
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
            width: 80%;
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
            <h2>CADASTRE-SE</h2>
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
                    <input type="text" name="cpf" id="cpf" maxlength="12" oninput="formatarCPF(this)" required>
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
                    <input type="password" name="hash_senha" required>
                    <label for="hash_senha">Senha</label>
                </div>
                <div class="input-container">
                    <input type="text" name="estado" value="PR" readonly>
                    <label for="estado"></label>
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
            Já tem uma conta? <a href="login.php">Entrar</a>
        </p>
    </div>
</body>
</html>


<?php
//Se o botão foi pressionado
if (isset($_POST['btnSalvar'])) {
    //receber o valor dos inputs
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $gmail = $_POST['gmail'];
    $cpf = $_POST['cpf'];
    $complemento = $_POST['complemento'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    // Alteramos a tabela e permitimos a criptografia da Senha
    // MD5($variavel);
    // tem que ter 32 caracteres
    //$hash_senha = md5($_POST['hash_senha']); // se deixar essa use linha 58
    $hash_senha = $_POST['hash_senha'];
    $estado = $_POST['estado'];
    $cod_cidade = $_POST['cod_cidade'];

    // definindo os valores de tipocliente e ativo
    $tipocliente = 'C';
    $ativo = 'S';

    // validando se foi informado dados no formulário
    if (empty($_POST['nome']) && empty($_POST['gmail']) && empty($_POST['hash_senha'])) {
        echo "Preencha todos os campos";
        exit();
    }

    // SQL que faz a inserção dos dados na tabela
    $sql = "INSERT INTO tb_clientes ( nome, telefone, gmail, cpf, tipocliente, ativo, complemento, rua, numero, bairro, hash_senha, cod_cidade) VALUES (:nome, :telefone, :gmail, :cpf, :tipocliente, :ativo, :complemento, :rua, :numero, :bairro, :hash_senha, :cod_cidade)";
    // colocando uma forma de não correr risco com sql injection
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
    $s = md5($hash_senha);
    $stmt->bindParam(':hash_senha', $hash_senha);
    $stmt->bindParam(':cod_cidade', $cod_cidade);

    // executar o sql 
    if ($stmt->execute()) {
        echo "Cliente cadastrado com sucesso";
        //header("Location: index.php");
    } else {
        echo "Erro ao cadastrar o cliente";
    }
}
?>