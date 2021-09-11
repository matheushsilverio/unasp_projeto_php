<?php

session_start();
include("conexao.php");

if(empty($_POST['usuario']) || empty($_POST['senha'])){
    echo "Usuário ou senha não informado";
    echo "<meta http-equiv='refresh' content='3;url=index.php'>";
    exit();
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$select = "SELECT ID FROM usuario WHERE usuario = '{$usuario}' AND senha = '{$senha}'";

$row = mysqli_num_rows(mysqli_query($conexao, $select));

if($row){
    $_SESSION['usuario'] = $usuario;
    $_SESSION['autorizacao'] = true;
    header("Location: index.php");
    exit();
}else{
    $_SESSION['autorizacao'] = false;
    header("Location: login.php");
    exit();
}

