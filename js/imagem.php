<?php
include_once 'conexao.php';
$pdo = conectar();

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["produto"])) {
        $produto = $_POST["produto"];

        // Diretório para salvar as imagens (certifique-se de ter permissões de escrita)
        $diretorio = "imagens/";

        // Verifica se o arquivo foi enviado corretamente
        if (isset($_FILES["imagem"])) {
            // Informações sobre o arquivo enviado
           // Verifica se o arquivo é uma imagem
            $permitidos = array("jpg", "jpeg", "png", "gif"); 
            $nomeArquivo = $_FILES["imagem"]["name"];
            $caminhoArquivo = $diretorio . $nomeArquivo . $permitidos;
            $tipoArquivo = pathinfo($caminhoArquivo, PATHINFO_EXTENSION);

            
            if (!in_array(strtolower($tipoArquivo), $permitidos)) {
                // Move o arquivo para o diretório de imagens
                if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminhoArquivo)) {
                    // Insere no banco de dados
                    $sql = "INSERT INTO tb_imagens_produtos (cod_produto, imagem_produto) VALUES (:produto, :caminhoArquivo)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':produto', $produto, PDO::PARAM_INT);
                    $stmt->bindParam(':caminhoArquivo', $caminhoArquivo, PDO::PARAM_STR);

                    if ($stmt->execute()) {
                        echo "Imagem adicionada com sucesso.";
                    } else {
                        echo "Erro ao adicionar imagem ao banco de dados.";
                    }
                } else {
                    echo "Erro ao fazer upload do arquivo.";
                }
            } else {
                echo "Formato de arquivo não suportado. Apenas JPG, JPEG, PNG e GIF são permitidos.";
            }
        } else {
            echo "Erro: Imagem não foi enviada corretamente.";
        }
    } else {
        echo "Erro: Produto não foi selecionado corretamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Imagem</title>
</head>
<body>
    <h2>Adicionar Imagem ao Produto</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="cod_produto">Selecione o Produto:</label>
        <select name="cod_produto" id="cod_produto">
            <?php
            // Utilizando o mesmo $pdo da conexão
            $stmt = $pdo->prepare("SELECT cod_produto, descricao FROM tb_produtos WHERE ativo = 'S'");
            $stmt->execute();

            // Preencher o campo de seleção com os produtos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['cod_produto']}'>{$row['descricao']}</option>";
            }
            ?>
        </select>

        <br>

        <label for="imagens">Escolha a Imagem:</label>
        <input type="file" name="imagens" id="imagens">

        <br>

        <button type="submit" name="cadastroBtn">Enviar</button>
    
    </form>
</body>
</html>
<?php 
//teste se o botão foi pressionado
if (isset($_POST["cadastroBtn"])) {
    $cod_produto = $_POST["cod_produto"];
    $endereco_imagem = $_POST["imagens"];

    $sql = "SELECT cod_detalhes_produtos FROM tb_detalhes_produtos WHERE cod_produto = :cod_produto";

    //Verifica se existe o diretorio para envio das imagens
    $diretorio_imagens = "imagens" . $cod_produto . "/";
    if(!is_dir($diretorio_imagens)){
        mkdir($diretorio_imagens, 0777, true);
    }

    //processamento do upload de imagens
    if(isset($_FILES['imagens/'])){
        $imagens = $_FILES['imagens/'];

        foreach($imagens['tmp_name'] as $key => $tmp_name){
            $endereco_imagem = $imagens['name'][$key];
            $endereco_imagem = $diretorio_imagens;

            // move a imagem para o diretorio
            move_uploaded_file($tmp_name, $endereco_imagem);

            // insira o registro da imagem na tabela imagens
            $inserirImagem = $pdo->prepare("INSERT INTO tb_imagens_produtos(endereco_imagem) VALUES (?)");

            $inserirImagem->execute([$endereco_imagem, $cod_produto]);          
        }
    }
    // enviar para outra pagina
    //0header("Location: incproduto.php");
    exit();
}
?>
