<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cod_produto'])) {
        $cod_produto = $_POST['cod_produto'];

        // Adiciona o produto ao produtos
        if (!isset($_SESSION['produtos'])) {
            $_SESSION['produtos'] = array();
        }

        if (!isset($_SESSION['produtos'][$cod_produto])) {
            $_SESSION['produtos'][$cod_produto] = 1;
        } else {
            $_SESSION['produtos'][$cod_produto]++;
        }

        // Redireciona para a página do produtos
        header('Location: testedeproduto.php');
        exit();
    }
}
?>