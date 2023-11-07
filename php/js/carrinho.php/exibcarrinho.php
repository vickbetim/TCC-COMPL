<?php
session_start();

if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0) {
    echo "Itens no Carrinho:<br>";
    foreach ($_SESSION['carrinho'] as $product_id) {
        // Recupere informações do produto a partir do banco de dados usando $product_id
    }
} else {
    echo "Seu carrinho está vazio.";
}
?>
