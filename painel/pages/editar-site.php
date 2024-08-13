<?php

    $site = Painel::select('tb_siteconfig', false);;

?>

<div class="box-content">
    <h2><i class="fa-solid fa-comments"></i> Editar configurações</h2>

    <form method="post" enctype="multipart/form-data">

        <?php

        if (isset($_POST['acao'])) {
            if (Painel::update($_POST,true)) {
                Painel::alert('sucesso', 'Site editado com sucesso!');
                $site = Painel::select('tb_siteconfig', false);
            } else {
                Painel::alert('erro', 'Campos vázios não são permitidos!');
            }
        }

        ?>

        <div class="form-group">
            <label for="depoimento-nome">Titulo do site:</label>
            <input style="padding-left:10px" name="titulo" value="<?php echo $site['titulo'] ?>" />
        </div>

        
        <div class="form-group">
            <label for="depoimento-nome">Nome do autor do site:</label>
            <input style="padding-left:10px" name="nome_autor" value="<?php echo $site['nome_autor'] ?>" />
        </div>

        <div class="form-group">
            <label for="depoimento-nome">Descrição do autor:</label>
            <textarea style="padding-left:10px" name="descricao" rows=7><?php echo $site['descricao'] ?></textarea>
        </div>

        <?php for($i = 1; $i <=3;$i++){ ?>
            <div class="form-group">
                <label for="Icone<?php echo $i ?>:">Icone<?php echo $i?>:</label>
                <input id="<?php echo $site['icone'.$i] ?>" style="padding-left:10px" name="icone<?php echo $i ?>" value="<?php echo $site['icone'.$i] ?>" />
            </div>
            <div class="form-group">
                <label>Descrição do icone<?php echo $i ?>:</label>
                <textarea style="padding-left:10px" name="descricao<?php echo $i?>" rows=7><?php echo $site['descricao'.$i] ?></textarea>
            </div>
        <?php } ?>

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $site['id'] ?>">
            <input type="hidden" name="nome_tabela" value="tb_siteconfig">
            <input type="submit" name="acao" value="Atualizar">
        </div>
    </form>
</div>