<div class="box-content">
    <h2><i class="fa-solid fa-comments"></i> Adicionar novo depoimento</h2>

    <form method="post" enctype="multipart/form-data">

        <?php

        if (isset($_POST['acao'])) {
            if (Painel::insert($_POST)) {
                Painel::alert('sucesso', 'Depoimento cadastrado com sucesso!');
            } else {
                Painel::alert('erro', 'Campos vazios não são permitidos!');
            }
        }

        ?>

        <div class="form-group">
            <label for="depoimento-nome">Nome do cliente:</label>
            <input id="depoimento-nome" type="text" name="nome" autofocus placeholder="Digite o nome de usuário">
        </div>

        <div class="form-group">
            <label for="depoimento-texto">Depoimento do cliente:</label>
            <textarea rows="10" name="depoimentos"></textarea>
        </div>

        <div class="form-group">
            <label for="depoimento-texto">Data:</label>
            <input type="text" name="data">
        </div>

        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_sitedepoimentos">
            <input type="submit" name="acao" value="Novo depoimento">
        </div>
    </form>
</div>