<?php
session_start();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = array();
    }

    array_push($_SESSION['carrinho'], $product_id);
}
header("Location: listaprodutos2.php");


?>
