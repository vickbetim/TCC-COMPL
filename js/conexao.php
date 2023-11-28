<?php

function conectar(){

    $host   = "localhost";
    $db     = "c3solucoes";
    $user   = "root";
    $pass   ="";
    
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    return $pdo;
}
?>

