<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cod_produto'])) {
        $cod_produto = $_POST['cod_produto'];

        // Adiciona o produto ao carrinho
        if (!isset($_SESSION['carrinho'])) {
            $_SESSION['carrinho'] = array();
        }

        if (!isset($_SESSION['carrinho'][$cod_produto])) {
            $_SESSION['carrinho'][$cod_produto] = 1;
        } else {
            $_SESSION['carrinho'][$cod_produto]++;
        }

        // Redireciona para a página do carrinho
        header('Location: carr.php');
        exit();
    }
}
?>