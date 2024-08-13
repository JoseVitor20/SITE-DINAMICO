<?php
if (isset($_GET['logout'])) {
    Painel::logout();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL; ?>css/dist/style.css">
    <script src="https://kit.fontawesome.com/388ade4391.js" crossorigin="anonymous"></script>
    <title>Painel de controle</title>
</head>

<body>

    <main class="painel-controle">

        <div class="menu">
            <div class="menu-wrapper">
                <div class="box-usuario">

                    <?php if ($_SESSION['imagem'] == '') { ?>
                        <div class="avatar-usuario">
                            <i class="fa fa-user"></i>
                        </div>
                    <?php } else { ?>
                        <div class="avatar-usuario">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['imagem'] ?>" alt="Usuário">
                        </div>
                    <?php } ?>

                    <div class="nome-usuario">
                        <p><?php echo $_SESSION['nome']; ?></p>
                        <p><?php echo Painel::$cargos[$_SESSION['cargo']]; ?></p>
                    </div>
                </div>
                <div class="items-menu">
                    <h2>Cadastro</h2>
                    <a <?php selecionadoMenu('cadastrar-depoimentos') ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>cadastrar-depoimentos">Cadastrar Depoimentos</a>
                    <a <?php selecionadoMenu('cadastrar-serviços') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servicos">Cadastrar Serviços</a>
                    <a <?php selecionadoMenu('cadastrar-slides') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-slides">Cadastrar Slides</a>
                    <h2>Gestão</h2>
                    <a <?php selecionadoMenu('listar-depoimentos') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar Depoimentos</a>
                    <a <?php selecionadoMenu('listar-servicos') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Servicos</a>
                    <a <?php selecionadoMenu('listar-slides') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides">Listar Slides</a>
                    <h2>Administração</h2>
                    <a <?php selecionadoMenu('editar-usuario') ?> href="<?php echo INCLUDE_PATH_PAINEL; ?>editar-usuario" style="cursor: pointer;">Editar Usuário</a>
                    <a <?php selecionadoMenu('adicionar-usuario') ?> <?php verificarPermissaoMenu(2) ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">Adicionar Usuário</a>
                    <h2>Configuração Geral</h2>
                    <a <?php selecionadoMenu('editar-site') ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-site">Editar Site</a>
                </div>
            </div>
        </div>

        <header>
            <div class="center">
                <div class="menu-btn">
                    <i class="fa fa-bars"></i>
                </div>
                <div class="logout">
                    <a <?php if (@$_GET['url'] == '') { ?> style="background-color: rgb(177, 177, 177);padding:15px" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>">Página Inicial <i class="fas fa-home"></i></a>
                    <div style="padding:0 20px;display:inline"></div>
                    <a href="<?php echo INCLUDE_PATH_PAINEL ?>?logout">Log-out <i class="fas fa-door-open"></i></a>
                </div>
                <div class="clear"></div>
            </div>
        </header>

        <section class="content">

            <?php Painel::carregarPagina(); ?>

        </section>

        <div class="clear"></div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/dist/main.dev.js"></script>

</body>

</html>