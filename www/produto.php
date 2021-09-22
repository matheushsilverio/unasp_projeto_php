<?php
session_start();
require("conexao.php");
include("verificaLogin.php");
$queryProduto = "SELECT * FROM produto WHERE hash = '{$_SESSION['idProduto']}'";
$resultProduto = mysqli_query($conexao, $queryProduto) or die(mysqli_error($conexao));
$existeProd = true;
if (!mysqli_num_rows($resultProduto)) {
    $existeProd = false;
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
                <form class="login100-form validate-form" action="produtoCrud.php" method="POST">
                    <span class="login100-form-title">
                        Produto
                    </span>

                    <input class="input100" type="hidden" name="hash" value="<?php echo ($_SESSION['idProduto']); ?>" />

                    <?php
                    if ($existeProd) {
                        while ($prod = mysqli_fetch_object($resultProduto)) {
                            echo '
                                <div class="wrap-input100">
                                    <input class="input100" type="text" name="nome" placeholder="Nome" value="' . $prod->nome . '" />
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="fa fa-product-hunt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="wrap-input100">
                                    <input class="input100" type="number" name="quantidade" placeholder="Quantidade" value="' . $prod->quantidade . '" />
                                    <span class="symbol-input100">
                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                    </span>
                                </div>
                            ';
                        }
                    } else {
                        echo '
                            <div class="wrap-input100">
                                <input class="input100" type="text" name="nome" placeholder="Nome" />
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-product-hunt" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="wrap-input100">
                                <input class="input100" type="number" name="quantidade" placeholder="Quantidade" />
                                <span class="symbol-input100">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                </span>
                            </div>
                        ';
                    }

                    ?>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            <?php
                            if ($existeProd) {
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