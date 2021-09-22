<?php
session_start();
include("conexao.php");

if (empty(trim($_POST['nome'])) || empty(trim($_POST['quantidade']))) {
    $_SESSION['erro'] =  "Dados incompletos!";
    header("Location: produto.php");
} else {
    $_SESSION['erro'] =  " ";
    $hash = $_POST['hash'];
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];

    if (empty(trim($hash))) {
        $hash = md5(uniqid(rand(), true));
        $query = "INSERT INTO produto (hash, nome, quantidade) VALUES ('$hash', '$nome', '$quantidade')";
    } else {
        $query = "UPDATE produto SET nome = '$nome', quantidade = '$quantidade' WHERE hash = '$hash'";
    }
    mysqli_query($conexao, $query) or die(mysqli_error($conexao));
    header("Location: index.php");
}
exit();
