<?php
session_start();

if (isset($_GET['id']) && isset($_GET['quantidade'])) {
    $product_id = $_GET['id'];
    $quantidade = $_GET['quantidade'];

    if (isset($_SESSION['carrinho'][$product_id])) {
        $_SESSION['carrinho'][$product_id] = $quantidade;
    }
}
header("Location: listaprodutos2.php");
?>
