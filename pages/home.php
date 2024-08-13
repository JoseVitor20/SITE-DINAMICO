<section class="banner-container">
    <div class="slide">

        <?php
            $selectImagem = MySql::conectar()->prepare("SELECT slides FROM tb_siteslides");
            $selectImagem->execute();
            $imagem = $selectImagem->fetchAll(PDO::FETCH_ASSOC);

            foreach ($imagem as $key => $value) {
        ?>

        <img class="slide-img" src="<?php echo INCLUDE_PATH_PAINEL  ?>uploads/slide/<?php echo $value['slides']?>" alt="">

        <?php } ?>
        
        <div class="control">
            <div class="slide-bollets">
                <span class="active-slide"></span>
            </div>
        </div>
    </div>
    <div class="overlay"></div>
    <div class="center">
        <form method="post" action="">
            <!-- Input usado para válidar qual formulário deve ser executado, esse ou o da página contato -->
            <h2>Qual seu melhor e-mail?</h2>
            <input type="email" name="email" require />
            <input type="submit" name="acao" value="Cadastrar" />
        </form>
    </div><!--center-->
</section><!--banner-container-->

<section class="descricao-autor">
    <div class="center">
        <div class="w50 left">
            <h2><?php echo $infoSite['nome_autor'] ?></h2>
            <p><?php echo $infoSite['descricao'] ?></p>
        </div>
        <div class="w50 left">
            <img class="right" src="<?php echo INCLUDE_PATH_PAINEL ?>/uploads/<?php echo $_SESSION['imagem'] ?>" alt="José">
        </div>
        <div class="clear"></div>
    </div><!--center-->
</section><!--descricao-autor-->

<section id="servicos" class="especialidades">
    <div class="center">
        <h2 class="title">Especialidades</h2>
        <div class="w33 left box-especialidades">
            <h3><i class="<?php echo $infoSite['icone1']?>"></i></h3>
            <h4>HTML</h4>
            <p><?php echo $infoSite['descricao1']?></p>
        </div>
        <div class="w33 left box-especialidades">
        <h3><i class="<?php echo $infoSite['icone2']?>"></i></h3>
            <h4>HTML</h4>
            <p><?php echo $infoSite['descricao2']?></p>
        </div>
        <div class="w33 left box-especialidades">
        <h3><i class="<?php echo $infoSite['icone3']?>"></i></h3>
            <h4>HTML</h4>
            <p><?php echo $infoSite['descricao3']?></p>
        </div>
        <div class="clear"></div>
    </div><!--center-->
</section><!--especialidades-->

<section id="sobre" class="extras">
    <div class="center">
        <div class="w50 left depoimentos-container">
            <h2 class="title">Depoimentos dos nossos clientes</h2>

            <?php

            $sql = MySql::conectar()->prepare("SELECT * FROM tb_sitedepoimentos ORDER BY order_id ASC LIMIT 3");
            $sql->execute();
            $depoimentos = $sql->fetchAll();

            foreach ($depoimentos as $key => $value) {

            ?>

                <div class="depoimentos-simgle">
                    <q><?php echo  $value['depoimento'] ?></q>
                    <p class="nome-autor"><?php echo $value['nome'] ?> - <?php echo $value['data'] ?></p>
                </div><!--depoimentos-simgle-->

            <?php } ?>


        </div>
        <div class="w50 left servicos-container">
            <h2 class="title">Serviços</h2>
            <div>
                <ul>
                <?php
                    $sql = MySql::conectar()->prepare("SELECT * FROM tb_siteservicos ORDER BY order_id ASC LIMIT 3");
                    $sql->execute();
                    $servicos = $sql->fetchAll();

                    foreach ($servicos as $key => $value) {
                ?>
                    <li><?php echo $value['servico']; ?></li>
                <?php } ?>
                        
                </ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</section><!--extras-->