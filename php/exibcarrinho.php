<?php
session_start();

if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    echo "Itens no Carrinho:<br>";
    foreach ($_SESSION['carrinho'] as $cod_produto) {
        // Recupere informações do produto a partir do banco de dados usando $product_id
    }
} else {
    echo "Seu carrinho está vazio.";
}
header("Location: carr.php");
?>
