<?php
session_start();

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    if (isset($_SESSION['carr'][$product_id])) {
        unset($_SESSION['carr'][$product_id]);
    }
}
header("Location: carr.php");
?>
