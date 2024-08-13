<div class="box-content">
    <h2><i class="fa-solid fa-comments"></i> Adicionar novo serviço</h2>

    <form method="post" enctype="multipart/form-data">

        <?php

        if (isset($_POST['acao'])) {
            if (Painel::insert($_POST)) {
                Painel::alert('sucesso', 'Novo serviço cadastrado com sucesso!');
            } else {
                Painel::alert('erro', 'Campos vazios não são permitidos!');
            }
        }

        ?>

        <div class="form-group">
            <label for="depoimento-nome">Descreva o serviço</label>
            <input id="depoimento-nome" type="text" name="nome" autofocus placeholder="Digite o nome de usuário">
        </div>

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_siteservicos">
            <input type="submit" name="acao" value="Novo depoimento">
        </div>
    </form>
</div>