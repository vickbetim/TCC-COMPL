<?php

function obterDataAtual() {
    $dataAtual = date('d/m/y H:i:s');
    return $dataAtual;
}


include_once 'carr.php';

// Chame a função para obter a data atual
$dataAtual = obterDataAtual();

// Use a variável $dataAtual conforme necessário no seu script
echo $dataAtual;
?>