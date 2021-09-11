<?php

require("conexao.php");

$query = "SELECT * FROM usuario";
$result = mysqli_query($conexao, $query) or die(mysqli_error($conexao));

$mensagem = "";
if(!mysqli_num_rows($result)){
    $mensagem = "Nenhum usuario encontrado";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Lista de usuarios</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
                <?php
                    echo $mensagem;
                ?>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Senha</th>
                        <th>md5</th>
                        <th>sha1</th>
                        <th>base64</th>
                        <th>Nome</th>
                        <th>Email</th>
                    </thead>
                    <tbody>
                        <?php
    
                            while($usuario = mysqli_fetch_object($result)){
                                echo "<tr>
                                        <td>" . $usuario->ID .      "</td>
                                        <td>" . $usuario->usuario . "</td>
                                        <td>" . $usuario->senha .   "</td>
                                        <td>" . $usuario->md5 .   "</td>
                                        <td>" . $usuario->sha1 .   "</td>
                                        <td>" . $usuario->base64 .   "</td>
                                        <td>" . $usuario->nome .    "</td>
                                        <td>" . $usuario->email .   "</td>
                                    </tr>";
                            }
                        ?>
                    </tbody>
                </table>

                <h2>Sha256</h2>
                <?php 
                    echo password_hash($usuario['senha'], PASSWORD_BCRYPT, ['cost' => 8, 'salt' => 'shhhhhhhhhhhhhh!']);
                ?>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>