<?php

require("conexao.php");
include("verificaLogin.php");

$queryUsuario = "SELECT * FROM usuario";
$resultUsuario = mysqli_query($conexao, $queryUsuario) or die(mysqli_error($conexao));

$mensagemUsuario = "";
if (!mysqli_num_rows($resultUsuario)) {
	$mensagemUsuario = "Não há usuários cadastrados";
}

$queryProduto = "SELECT * FROM produto";
$resultProduto = mysqli_query($conexao, $queryProduto) or die(mysqli_error($conexao));

$mensagemProduto = "";
if (!mysqli_num_rows($resultProduto)) {
	$mensagemProduto = "Não há produtos cadastrados!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Projeto MV</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/adicional.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
	<script>
		function mudarStatusBotao(tipo) {
			$("#motivoHash").hide();
			var nome = tipo === "produto" ? "usuario" : "produto";
			$("#" + nome).removeClass("btn-warning");
			$("#" + nome).addClass("btn-success");
			$("#" + tipo).removeClass("btn-success");
			$("#" + tipo).addClass("btn-warning");
			$("#" + tipo + "Tabela").show();
			$("#" + nome + "Tabela").hide();
		}

		function redirecionarProduto(hash) {
			$(".idProdutoRedirect").val(hash);
			$("#produtoRedirect").submit();
		}

		function redirecionarUsuario(id) {
			$(".idUsuarioRedirect").val(id);
			$("#usuarioRedirect").submit();
		}

		$(document).ready(function() {
			$("#produtoTabela").hide();
			$("#usuarioTabela").hide();
			$("#produto").click(function() {
				mudarStatusBotao("produto");
			});

			$("#usuario").click(function() {
				mudarStatusBotao("usuario");
			});

			$("#explicacao").click(function() {
				$("#produtoTabela").hide();
				$("#usuarioTabela").hide();
				$("#motivoHash").show();
				
				$(".btnS").removeClass("btn-warning");
				$(".btnS").addClass("btn-success");
			});

			
			
			$(".textoBusca").keyup(function () {
				var value = this.value.toLowerCase().trim();

				$("#tabelaProdutos tbody tr").each(function (index) {
					if (!index) return;
					$(this).find("td").each(function () {
						var id = $(this).text().toLowerCase().trim();
						var not_found = (id.indexOf(value) == -1);
						$(this).closest('tr').toggle(!not_found);
						return not_found;
					});
				});
			});
			
		});
	</script>
</head>

<body>

	<div class="limiter">
		<form id="produtoRedirect" action="redirectProduto.php" method="POST">
			<input class="idProdutoRedirect" type="hidden" name="idProduto" />
		</form>
		<form id="usuarioRedirect" action="redirectUsuario.php" method="POST">
			<input class="idUsuarioRedirect" type="hidden" name="editUsuario" />
		</form>
		<div class="container-login100">
			<div class="wrap-inicial" id="overflowStyle">
				<div class="container-fluid">
					<div class="row d-flex flex-row-reverse bd-highlight">
						<div class="p-2 bd-highlight">
							<a style="color: red" href="sessionDestroy.php">Sair <i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="row justify-content-start">
						<div class="col-2">
							<button id="explicacao" class="btn btn-default">Motivo da senha</button>
							<br /><br />
							<button id="produto" class="btn btn-success btnS">Produtos</button>
							<br /><br />
							<button id="usuario" class="btn btn-success btnS">Usuários</button>
							<br />
						</div>
						<div id="produtoTabela" class="col-8">
							<div class="row justify-content-start col-3">
								<a class="btn btn-primary" href="#" onClick="redirecionarProduto(0)">Novo Produto</a>
							</div>
							<br />
							<div class="row justify-content-center" style="color: red;">
								<?php echo $mensagemProduto; ?>
							</div>
							<br />
							<div class="row float-right col-3">
								<div class="wrap-input100">
									<input class="input100 textoBusca" type="text" placeholder="Buscar">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-search" aria-hidden="true"></i>
									</span>
								</div>
							</div>
							<br />
							<table id="tabelaProdutos">
								<tr>
									<th>Hash</th>
									<th>Nome</th>
									<th>Quatidade</th>
									<th>Data</th>
									<th>Editar</th>
								</tr>
								<?php
								while ($prod = mysqli_fetch_object($resultProduto)) {
									$type = '"' . $prod->hash . '"';
									echo "<tr>
											<td>" . $prod->hash .      "</td>
											<td>" . $prod->nome .    "</td>
											<td>" . $prod->quantidade .   "</td>
											<td>" . $prod->data .   "</td>
											<td style='text-align:center' ><button class='btn btn-sm btn-primary' onClick='redirecionarProduto(" . $type . ")' title='Editar'><i class='fa fa-eye'></i></button></td>
										</tr>";
								}
								?>
							</table>
						</div>
						<div id="usuarioTabela" class="col-8">
							<div class="row justify-content-start col-3">
								<a class="btn btn-primary" href="#" onClick="redirecionarUsuario(0)">Novo Usuário</a>
							</div>
							<br />
							<div class="row justify-content-center" style="color: red;">
								<?php echo $mensagemUsuario; ?>
							</div>
							<br />
							<table>
								<tr>
									<th>Id</th>
									<th>Nome</th>
									<th>E-mail</th>
									<th>Editar</th>
								</tr>
								<?php
								while ($usuario = mysqli_fetch_object($resultUsuario)) {
									$style = "";
									if ($_SESSION['usuario'] == $usuario->usuario) {
										$style = "style='background-color: #97F08A' title='Usuário logado'";
									}
									echo "<tr " . $style . ">
												<td>" . $usuario->id .      "</td>
												<td>" . $usuario->nome .    "</td>
												<td>" . $usuario->email .   "</td>
												<td style='text-align:center' ><button class='btn btn-sm btn-primary' onClick='redirecionarUsuario(" . $usuario->id . ")' title='Editar'><i class='fa fa-eye'></i></button></td>
											</tr>";
								}
								?>
							</table>
						</div>
						<div id="motivoHash" class="col-8">
							<div class="row justify-content-center">
								<h1>Explicação Criptografia</h1>
								<p>
									<br/><br/>
									Nossa criptografia é iniciada por um <b>strrev</b>, este comando inverte o texto escrito. Posteriormente é implementado dois tipos de criptografia já utilizados, o SHA1 e o MD5, finalizado está etapa, é realizado um bcrypt com um salt de 22 caracteres que nós criamos para fazer parte da criptografia da senha. É uma implementação simples que traz uma segurança para o nosso usuário no salvamento de sua senha em nosso banco de dados.
								</p>
							</div>
							<br />
							<div class="row justify-content-center">
								<br/>
								<p>Dupla: Matheus Henrique e Vinicius Gonçalves
								<br/>
								RA: 057782 e 057088</p>
							</div>
							
						</div>
					</div>
				</div>
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
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>

</html>