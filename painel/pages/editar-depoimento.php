<?php

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $depoimento = Painel::select('tb_sitedepoimentos', 'id=?', [$id]);
} else {
    Painel::alert('erro', 'Você precisa passar o parâmetro id');
    die();
}

?>

<div class="box-content">
    <h2><i class="fa-solid fa-comments"></i> Editar depoimento</h2>

    <form method="post" enctype="multipart/form-data">

        <?php

        if (isset($_POST['acao'])) {
            if (Painel::update($_POST)) {
                Painel::alert('sucesso', 'Depoimento editado com sucesso!');
                $depoimento = Painel::select('tb_sitedepoimentos', 'id=?', [$id]);
            } else {
                Painel::alert('erro', 'Campos vázios não são permitidos!');
            }
        }

        ?>

        <div class="form-group">
            <label for="depoimento-nome">Nome do cliente:</label>
            <input id="depoimento-nome" type="text" name="nome" value="<?php echo $depoimento['nome'] ?>" autofocus placeholder="Digite o nome de usuário">
        </div>

        <div class="form-group">
            <label for="depoimento-texto">Depoimento do cliente:</label>
            <textarea rows="10" name="depoimento"><?php echo $depoimento['depoimento'] ?></textarea>
        </div>

        <div class="form-group">
            <label for="depoimento-texto">Data:</label>
            <input type="text" name="data" value="<?php echo $depoimento['data'] ?>">
        </div>

        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $depoimento['id'] ?>">
            <input type="hidden" name="nome_tabela" value="tb_sitedepoimentos">
            <input type="submit" name="acao" value="Atualizar">
        </div>
    </form>
</div>