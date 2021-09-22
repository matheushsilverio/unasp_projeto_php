<?php
session_start();
require("conexao.php");
include("verificaLogin.php");
$queryUsuario = "SELECT * FROM usuario WHERE id = '{$_SESSION['editUsuario']}'";
$resultUsuario = mysqli_query($conexao, $queryUsuario) or die(mysqli_error($conexao));
$existeUsuario = true;
if (!mysqli_num_rows($resultUsuario)) {
    $existeUsuario = false;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Projeto MV</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/adicional.css">
</head>

<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="usuarioCrud.php" method="POST">
					<span class="login100-form-title">
						Usuário
					</span>
					<input class="input100" type="hidden" name="id" value="<?php echo ($_SESSION['editUsuario']); ?>" />

                    <?php
                    if ($existeUsuario) {
                        while ($user = mysqli_fetch_object($resultUsuario)) {
                            echo '
							<div class="wrap-input100">
								<input class="input100" type="text" name="nome" placeholder="Nome" value="' . $user->nome . '" />
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-user" aria-hidden="true"></i>
								</span>
							</div>
		
							<div class="wrap-input100" data-validate="Valid email is required: ex@abc.xyz">
								<input class="input100" type="text" name="email" placeholder="Email" value="' . $user->email . '" />
								<span class="symbol-input100">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</span>
							</div>
		
							<div class="wrap-input100">
								<input class="input100" type="text" placeholder="Usuario" disabled value="' . $user->usuario . '" />
								<input class="input100" type="hidden" name="usuario" placeholder="Usuario" value="' . $user->usuario . '" />
								<span class="symbol-input100">
									<i class="fa fa-at" aria-hidden="true"></i>
								</span>
							</div>
		
							<div class="wrap-input100" data-validate="Password is required">
								<input class="input100" type="password" name="senha" placeholder="Senha" required/>
								<span class="focus-input100"></span>
								<span class="symbol-input100">
									<i class="fa fa-lock" aria-hidden="true"></i>
								</span>
							</div>
                            ';
                        }
                    } else {
                        echo '
						<div class="wrap-input100">
							<input class="input100" type="text" name="nome" placeholder="Nome">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-user" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100" data-validate="Valid email is required: ex@abc.xyz">
							<input class="input100" type="text" name="email" placeholder="Email">
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100">
							<input class="input100" type="text" name="usuario" placeholder="Usuario" required/>
							<span class="symbol-input100">
								<i class="fa fa-at" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100" data-validate="Password is required">
							<input class="input100" type="password" name="senha" placeholder="Senha" required/>
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
                        ';
                    }

                    ?>
					

					<div class="text-center p-t-12">
						<span class="txt1" style="color: red;">
							<?php
							echo ($_SESSION['erro']);
							?>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							<?php
                            if ($existeUsuario) {
                                echo ("Atualizar");
                            } else {
                                echo ("Criar");
                            }
                            ?>
						</button>
						<br /><br />
						<a class="login100-form-danger" href="index.php">
							Voltar
						</a>
					</div>
					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<script src="js/main.js"></script>
</body>

</html>