<?php

if(!isset($_POST['nome']) && !isset($_POST['email']) && !isset($_POST['usuario']) && !isset($_POST['senha'])){
    echo "Dados incompletos para cadastro";
    exit;
}

include("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$md5 = md5($senha);
$sha1 = sha1($senha);
$base64 = base64_encode($senha);

//var_export($_POST);

$query = "INSERT INTO usuario (usuario, senha, md5, sha1, base64, nome, email) VALUES ('$usuario', '$senha', '$md5', '$sha1', '$base64', '$nome', '$email')";
mysqli_query($conexao, $query) or die(mysqli_error($conexao));


header("Location: listar.php");

