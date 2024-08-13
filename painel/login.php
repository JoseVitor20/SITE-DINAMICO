<?php

if (isset($_COOKIE['lembrar'])) {
    $user = $_COOKIE['user'];
    $password = $_COOKIE['password'];
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_adminUsuario` WHERE user=? AND password=?");
    $sql->execute([$user, $password]);

    if ($sql->rowCount() == 1) {
        $info = $sql->fetch();
        $_SESSION['login'] = true; // Ativar o else do arquivo index.php
        $_SESSION['user'] = $user;
        $_SESSION['password'] = $password;
        $_SESSION['nome'] = $info['nome'];
        $_SESSION['cargo'] = $info['cargo'];
        $_SESSION['imagem'] = $info['img'];
        header('Location: ' . INCLUDE_PATH_PAINEL);
        exit();
    }
} else {
    setcookie('user', '', time() - 1, '/');
    setcookie('password', '', time() - 1, '/');
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site dinâmico">
    <meta name="author" content="José Vitor" />
    <script src="https://kit.fontawesome.com/388ade4391.js" crossorigin="anonymous"></script>
    <title>Painel de controle</title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/dist/style.css">
</head>

<body>
    <div class="box-login">
        <form method="post">
            <?php
            if (isset($_POST['acao'])) {
                $user = $_POST['user'];
                $password = $_POST['password'];
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_adminUsuario` WHERE user=? AND password=?");
                $sql->execute([$user, $password]);
                if ($sql->rowCount() == 1) {
                    $info = $sql->fetch();
                    $_SESSION['login'] = true; // Ativar o else do arquivo index.php
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    $_SESSION['nome'] = $info['nome'];
                    $_SESSION['cargo'] = $info['cargo'];
                    $_SESSION['imagem'] = $info['img'];
                    if (isset($_POST['lembrar'])) {
                        setcookie('lembrar', 'true', time() + 60 * 60 * 24, '/');
                        setcookie('user', $user, time() + 60 * 60 * 24, '/');
                        setcookie('password', $password, time() + 60 * 60 * 24, '/');
                    }
                    header('Location: ' . INCLUDE_PATH_PAINEL);
                    exit();
                } else {
                    echo '<div class="erro-box"><i class="fas fa-xmark"></i>Usuário ou senha incorretos!</div>';
                }
            }

            ?>
            <fieldset>Fazer log-in</fieldset>
            <input type="text" name="user" placeholder="Login..." require />
            <input type="password" name="password" placeholder="Senha..." require />
            <div class="form-group-login right">
                <label for="LembrarLogin">Lembrar log-in</label>
                <input type="checkbox" name="lembrar">
            </div>
            <div class="clear"></div>
            <input id="LembrarLogin" type="submit" name="acao" placeholder="Logar" />
        </form>
    </div><!--box-login-->

</body>

</html>