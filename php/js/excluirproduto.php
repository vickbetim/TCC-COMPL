<?php
include_once("conexao.php");

$pdo = conectar();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tb_produtos WHERE cod_produto = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produto) {
        $sqlExcluir = "DELETE FROM tb_produtos WHERE cod_produto = :id";
        $stmtExcluir = $pdo->prepare($sqlExcluir);
        $stmtExcluir->bindParam(':id', $id);

        if ($stmtExcluir->execute()) {
            echo "Produto excluído com sucesso.";
        } else {
            echo "Erro ao excluir o produto.";
        }
    } else {
        echo "Produto não encontrado.";
    }
} else {
    echo "ID do produto não especificado.";
}
?>
