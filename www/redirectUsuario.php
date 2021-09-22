<?php
    session_start();    
    $_SESSION['erro'] =  " ";
    $id = $_POST['editUsuario'];
    if($id != '0') {
        $_SESSION['editUsuario'] = $id;
    } else {
        $_SESSION['editUsuario'] = '';
    }
    header("Location: usuario.php");
    exit();
