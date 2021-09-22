<?php
require_once("criptografarSenha.php");

session_start();
include("conexao.php");
$usuario = $_POST['usuario'];
$senhaInput = $_POST['senha'];

if (empty($usuario) || empty($senhaInput)) {
    $_SESSION['senhaerrada'] = "Usuário e/ou senha não informado!";
    $_SESSION['autorizacao'] = false;
    header("Location: login.php");
    //echo "<meta http-equiv='refresh' content='3;url=index.php'>";
    exit();
} else {
    $objSenha = new criptografarSenha();
    $senha = $objSenha->criptografar($senhaInput);

    $select = "SELECT ID FROM usuario WHERE usuario = '{$usuario}' AND senha = '{$senha}'";

    $row = mysqli_num_rows(mysqli_query($conexao, $select));

    if ($row) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['autorizacao'] = true;
        $_SESSION['senhaerrada'] = "";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['autorizacao'] = false;
        $_SESSION['senhaerrada'] = "Usuário e/ou senha inválidos!";
        header("Location: login.php");
        exit();
    }
}
