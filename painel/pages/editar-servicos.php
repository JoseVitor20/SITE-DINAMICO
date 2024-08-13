<?php

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $servico = Painel::select('tb_siteservicos', 'id=?', [$id]);
} else {
    Painel::alert('erro', 'Você precisa passar o parâmetro id');
    die();
}

?>

<div class="box-content">
    <h2><i class="fa-solid fa-comments"></i> Editar serviço</h2>

    <form method="post" enctype="multipart/form-data">

        <?php

        if (isset($_POST['acao'])) {
            if (Painel::update($_POST)) {
                Painel::alert('sucesso', 'Serviço editado com sucesso!');
                $servico = Painel::select('tb_siteservicos', 'id=?', [$id]);
            } else {
                Painel::alert('erro', 'Campos vázios não são permitidos!');
            }
        }

        ?>

        <div class="form-group">
            <label for="depoimento-nome">Serviço:</label>
            <textarea name="servico"><?php echo $servico['servico'] ?></textarea>
        </div>

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $servico['id'] ?>">
            <input type="hidden" name="nome_tabela" value="tb_siteservicos">
            <input type="submit" name="acao" value="Atualizar">
        </div>
    </form>
</div>