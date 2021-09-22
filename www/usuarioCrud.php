<?php
session_start();
include("conexao.php");

if (empty(trim($_POST['nome'])) || empty(trim($_POST['email'])) || empty(trim($_POST['usuario'])) || empty(trim($_POST['senha']))) {
    header("Location: usuario.php");
    $_SESSION['erro'] =  "Dados incompletos!";
    exit;
} else {
    require_once("criptografarSenha.php");

    $objSenha = new criptografarSenha();

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $objSenha->criptografar($_POST['senha']);

    if (empty(trim($id))) {
        $query = "INSERT INTO usuario (usuario, senha, nome, email) VALUES ('$usuario', '$senha', '$nome', '$email')";
    } else {
        $query = "UPDATE usuario SET nome = '$nome', email = '$email', senha = '$senha' WHERE id = '$id'";
    }
    mysqli_query($conexao, $query) or die(mysqli_error($conexao));
    header("Location: index.php");
}
