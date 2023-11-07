<?php
//session_start();
include_once "conexao.php";

$pdo = conectar();

// cidades
$sqlc = "SELECT * FROM tb_cidades";
$stmtc = $pdo->prepare($sqlc);
$stmtc->execute();
$dados = $stmtc->fetchAll(PDO::FETCH_ASSOC);
// FETCH_ASSOC  - $variavel['atributo'];
// FETCH_OBJ    - $variavel->atributo;

if (isset($_POST['btnSalvar'])) {
    // Receba o valor dos inputs
    $nome = $_POST['nome'];
    $telefone = $_POST['telefone'];
    $gmail = $_POST['gmail'];
    $cpf = $_POST['cpf'];

    // Consulta para verificar se o Gmail já existe
    $sqlCheckGmail = "SELECT * FROM tb_clientes WHERE gmail = :gmail";
    $stmtCheckGmail = $pdo->prepare($sqlCheckGmail);
    $stmtCheckGmail->bindParam(':gmail', $gmail);
    $stmtCheckGmail->execute();

    // Consulta para verificar se o CPF já existe
    $sqlCheckCPF = "SELECT * FROM tb_clientes WHERE cpf = :cpf";
    $stmtCheckCPF = $pdo->prepare($sqlCheckCPF);
    $stmtCheckCPF->bindParam(':cpf', $cpf);
    $stmtCheckCPF->execute();

    $sqlCheckTelefone = "SELECT * FROM tb_clientes WHERE telefone = :telefone";
    $stmtCheckTelefone = $pdo->prepare($sqlCheckTelefone);
    $stmtCheckTelefone->bindParam(':telefone', $telefone);
    $stmtCheckTelefone->execute();

    if ($stmtCheckGmail->rowCount() > 0) {
        // echo '<div class="mensagem-aviso">O Gmail já está em uso. Por favor, escolha outro.</div>';
    } elseif ($stmtCheckCPF->rowCount() > 0) {
        // echo '<div class="mensagem-aviso">O CPF já está em uso. Por favor, escolha outro.</div>';
    } elseif ($stmtCheckTelefone->rowCount() > 0) {
        // echo '<div class="mensagem-aviso">O telefone já está em uso. Por favor, escolha outro.</div>';
    } else {
        // Se nenhum dos campos estiver em uso, proceda com a inserção
        // ... (seu código de inserção existente) ...
    }
}
?>



<!DOCTYPE html>
<html lang="ptBR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
   


    <style>
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('defundo.png.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
           
            height: 100vh;
            margin: 0;
        }
        .menu-lateral {
    width: 50px;
    background-color: rgba(255, 255, 255, 0.7);
    color:  rgba(255, 255, 255, 0.9);
    position: fixed;
    height: 100%;
    top: 0;
    left: 0;
    transition: 0.3s;
    /* overflow-y: auto; */
}

.menu-lateral .btn-expandir {

    /* padding: 10px; */
    cursor: pointer;
}

.menu-lateral .btn-expandir i {
    font-size: 24px;
    margin-right: 10px;
}

.menu-lateral ul {
    list-style: none;
    padding: 0;
}

.menu-lateral .item-menu {
    width: 100%;
    padding: 15px;
    transition: background-color 0.3s;
}

.menu-lateral .item-menu:hover {
    width: 100%;
    background-color: rgba(200, 200, 200);
}

.menu-lateral a {
    text-decoration: none;
    display: flex;
    align-items: center;
    color: #000;
}

.menu-lateral .incon i {
    font-size: 20px;
    margin-right: 10px;
}

/* Você deve adicionar o texto nas classes .txt-link */

       
       
        .formContainer{
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 5%;
        }

        form {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 12px;
            width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
            color: rgb(0, 0, 0);
        }

        table {
            width: 100%;
        }

        table td {
            padding: 10px;
            border: 1px solid #DEB887;
            border-radius: 6px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #DEB887;
            border-radius: 6px;
        }

        button {
            background-color: #DEB887;
            border: none;
            padding: 15px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            box-shadow: 1px 1px 1px black;
            color: white;
            width: 100%;
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
        lado-1{
            display:flex;
        }
        lado-2{
            display:flex;
        }
        lado-3{
            display:flex;
        }
        lado-4{
            display:flex;
        }
        .mensagem-erro {
            position: absolute;
    background-color: #ff0000;
    padding: 10px;
    border: 1px solid #cc0000;
}
.mensagem-sucesso {
    position: absolute;
    background-color: green;
    padding: 10px;
    margin-top: 10px;
    border: 1px solid green;
    left:40%;
}

.mensagem-aviso {
    position: absolute;
    background-color: yellow;
    padding: 10px;
    border: 1px solid yellow;
    left: 38%;
    top:5px
}

        </style>
</head>


<body>
<header>
    
<nav class="menu-lateral">
    <div class="btn-expandir">
    
    <ul>
        <li class="item-menu">
            <a href="#">
                <span class="incon"><i class="bi bi-house-check"></i></span>
                <span class="txt-link"></span>
            </a>
        </li>
        <li class="item-menu">
            <a href="vmr.ver.php">
                <span class="incon"><i class="bi bi-basket"></i></span>
                <span class="txt-link"></span>
            </a>
        </li>
    </ul>
    </div>
</nav>
</header>

    <div class="formContainer">
    <form method="POST">
    <h2>Cadastro de Clientes</h2>
        <lado-1>
        <input type="text" name="nome" placeholder="Informe o nome">
        
        
        <input type="text" name="telefone" id="telefone" placeholder="Informe o seu telefone" maxlength="13" oninput="formatarTelefone(this)">
        </lado-1>
        <lado-2>
        <input type="text" name="gmail" placeholder="Informe gmail">
        
        
        <input type="text" name="cpf" id="cpf" placeholder="Informe o cpf" maxlength="11" oninput="validarNumeros(this)">
        </lado-2>
        
        <lado-3>
        <input class="teste" type="text" name="complemento" placeholder="Informe o seu complemento">
        
        
        <input class="teste" type="text" name="rua" placeholder="Informe a rua">
        </lado-3>
                <lado-4>
        <input type="text" name="numero" placeholder="Informe o numero">
        
        <input type="text" name="bairro" placeholder="Informe o seu bairro">
        </lado-4>
        
        <input type="password" name="senha" placeholder="Informe a senha">

        <input type="text" name="estado" value="PR">
            
    
            
        
        <select name="cod_cidade">
            <option>Selecione sua cidade</option>
            <?php foreach ($dados as $d) {
                echo "<option value='{$d['cod_cidade']}'>{$d['nome_cidade']}</option>";
            }
            ?>
        </select>

        <script>
function formatarTelefone(input) {
    input.value = input.value.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
    const value = input.value;

    if (value.length >= 2) {
        // Adicionar parênteses para o DDD
        input.value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
    }
}

function validarNumeros(input){
    input.value = input.value.replace(/\D/g, ""); // Remove todos os caracteres não numéricos
    const value = input.value;
}
</script>




        <input type="submit" name="btnSalvar" value="Salvar">
        <input type="hidden" name="tp" value="x">
    </form>
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
    //$senha = md5($_POST['senha']); // se deixar essa use linha 58
    $senha = $_POST['senha'];
    $estado = $_POST['estado'];
    $cod_cidade = $_POST['cod_cidade'];

    // definindo os valores de tipocliente e ativo
    $tipocliente = 'C';
    $ativo = 'S';

    // validando se foi informado dados no formulário
    if (empty($_POST['nome']) && empty($_POST['gmail']) && empty($_POST['senha'])) {
        echo '<div class="mensagem-aviso">Preencha todos os campos</div>';
        exit();
    }

    // SQL que faz a inserção dos dados na tabela
    $sql = "INSERT INTO tb_clientes ( nome, telefone, gmail, cpf, tipocliente, ativo, complemento, rua, numero, bairro, senha, cod_cidade) VALUES (:nome, :telefone, :gmail, :cpf, :tipocliente, :ativo, :complemento, :rua, :numero, :bairro, :senha, :cod_cidade)";
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
    $s = md5($senha);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':cod_cidade', $cod_cidade);

    // executar o sql 
    if ($stmt->execute()) {
        
        echo '<div class="mensagem-sucesso">Cliente cadastrado com sucesso</div>';
        //header("Location: index.php");
    } else {
        echo  '<div class="mensagem-erro">Erro ao cadastrar o cliente.</div>';
    }
}
?>