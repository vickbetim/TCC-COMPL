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
            $nomeArquivo = basename($_FILES["imagem"]["name"]);
            $caminhoArquivo = $diretorio . $nomeArquivo;
            $tipoArquivo = pathinfo($caminhoArquivo, PATHINFO_EXTENSION);

            // Verifica se o arquivo é uma imagem
            $permitidos = array("jpg", "jpeg", "png", "gif");
            if (in_array(strtolower($tipoArquivo), $permitidos)) {
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
                        echo "Erro ao adicionar imagem.";
                    }
                } else {
                    echo "Erro ao fazer upload do arquivo.";
                }
            } else {
                echo "Formato de arquivo não suportado. Apenas JPG, JPEG, PNG, e GIF são permitidos.";
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
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="produto">Selecione o Produto:</label>
        <select name="produto" id="produto">
            <?php
            include_once 'conexao.php';
            $pdo = conectar();

            // Buscar produtos no banco de dados
            $stmt = $pdo->prepare("SELECT cod_produto, descricao FROM tb_produtos WHERE ativo = 'S'");
            $stmt->execute();

            // Preencher o campo de seleção com os produtos
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='{$row['cod_produto']}'>{$row['descricao']}</option>";
            }
            ?>
        </select>

        <br>

        <label for="imagem">Escolha a Imagem:</label>
        <input type="file" name="imagem" id="imagem">

        <br>

        <input type="submit" href="addproduto.php" value="Adicionar Imagem">
    </form>
</body>
</html>
