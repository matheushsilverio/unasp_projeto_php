<?php
    session_start();    
    $_SESSION['erro'] =  " ";
    $idProduto = $_POST['idProduto'];
    if($idProduto != '0') {
        $_SESSION['idProduto'] = $idProduto;
    } else {
        $_SESSION['idProduto'] = '';
    }
    header("Location: produto.php");
    exit();
