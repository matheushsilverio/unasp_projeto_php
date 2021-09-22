<?php
session_start();
include("conexao.php");

if (empty(trim($_POST['nome'])) || empty(trim($_POST['email'])) || empty(trim($_POST['usuario'])) || empty(trim($_POST['senha']))) {
    header("Location: cadastro.php");
    $_SESSION['dados'] =  "Dados incompletos!";
    exit;
} else {
    require_once("criptografarSenha.php");

    $objSenha = new criptografarSenha();

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $objSenha->criptografar($_POST['senha']);
    $query = "INSERT INTO usuario (usuario, senha, nome, email) VALUES ('$usuario', '$senha', '$nome', '$email')";
    mysqli_query($conexao, $query) or die(mysqli_error($conexao));
    header("Location: login.php");
}
