<?php
include_once("conexao.php");

$pdo = conectar();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o cliente existe antes de excluí-lo
    $sql = "SELECT * FROM tb_clientes WHERE cod_cliente = :id";
    $stm = $pdo->prepare($sql);
    $stm->bindParam(':id', $id);
    $stm->execute();
    $cliente = $stm->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        // Exclui o cliente
        $sqlExcluir = "DELETE FROM tb_clientes WHERE cod_cliente = :id";
        $stmExcluir = $pdo->prepare($sqlExcluir);
        $stmExcluir->bindParam(':id', $id);
        if ($stmExcluir->execute()) {
            echo "Cliente excluído com sucesso.";
        } else {
            echo "Erro ao excluir o cliente.";
        }
    } else {
        echo "Cliente não encontrado.";
    }
} else {
    echo "ID do cliente não especificado.";
}
?>
