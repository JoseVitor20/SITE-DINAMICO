<?php
 include('config.php');
 
 $infoSite = MySql::conectar()->prepare("SELECT * FROM tb_siteconfig");
 $infoSite->execute();
 $infoSite = $infoSite->fetch();

?>

<?php Site::updateUsuarioOnline(); ?>

<?php Site::contador(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site dinâmico">
    <meta name="author" content="José Vitor" />
    <script src="https://kit.fontawesome.com/388ade4391.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>style/dist/style.css" />
    <title><?php echo $infoSite['titulo'] ?></title>
</head>

<body>

    <base base="<?php echo INCLUDE_PATH; ?>">

    <?php
    // Definir as elementos que possuirão scrollTop
    $url = isset($_GET['url']) ? $_GET['url'] : 'home';
    switch ($url) {
        case 'sobre':
            echo '
        <target target="sobre" />';
            break;
        case 'serviços':
            echo '
        <target target="servicos" />';
            break;
        default:
            echo '
        <target />';
            break;
    }
    // Definir as elementos que possuirão scrollTop
    ?>

    <header>
        <div class="center">
            <div class="logo left">Logomarca</div>
            <nav class="desktop right">
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>home">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>serviços">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                </ul>
            </nav><!--desktop-->
            <nav class="mobile right">
                <div class="botao-menu-mobile">
                    <i class="fa fa-bars"></i>
                </div>
                <ul>
                    <li><a href="<?php echo INCLUDE_PATH; ?>home">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>serviços">Serviços</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
                </ul>
            </nav><!--mobile-->
            <div class="clear"></div>
        </div><!--center-->
    </header>

    <main id="container-principal">
        <?php
        switch ($url) {
            case 'home':
            case 'sobre':
            case 'serviços':
                include('pages/home.php');
                break;
            case 'contato':
                include('pages/contato.php');
                break;
            default:
                if (!file_exists($url)) {
                    include('pages/404.php');
                } else {
                    include('pages/home.php');
                }
                break;
        }
        ?>

        <div class="sucesso">
            <h2>Formulário enviado com sucesso <i class="fa-solid fa-thumbs-up"></i></h2>
        </div>

        <div class="falha">
            <h2>Falha ao enviar o formulário <i class="fa-solid fa-thumbs-down"></i></h2>
            <p>Preencha o campo a baixo! </p>
        </div>

        <div class="overlay-loading">
            <img src="<?php echo INCLUDE_PATH; ?>./images/spinning.gif" alt="">
        </div>

    </main>

    <footer class='fixed'>
        <div class="center">
            <p>Todos os direitos reservados®</p>
        </div>
    </footer>

    <script src="<?php echo INCLUDE_PATH; ?>js/jQuery.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/javascript.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDED-tXlKuXAE_I2J0vM6FdoFHWr4fMrmE&callback=initMap&v=beta" defer></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>js/formulario.js"></script>
</body>

</html>

<!-- Enviando formulários -->