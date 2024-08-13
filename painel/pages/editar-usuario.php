<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Usuário</h2>
    <form method="post" enctype="multipart/form-data">

        <?php
        if (isset($_POST['acao'])) {
            $usuario = new Usuarios();
            $nome = $_POST['nome'];
            $senha = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $imagemDB = $_SESSION['imagem'];

            if ($imagem['name'] != '') {
                $formatoArquivo = explode('.', $imagem['name']);
                $extensao = end($formatoArquivo);
                $imagemID = uniqid() . '.' . $extensao;

                if (Painel::imagemValida($imagem)) {
                    Painel::deleteFile($imagemDB);
                    $imagem = Painel::uploadFile($imagem, $imagemID);

                    if ($usuario->atualizarUsuario($nome, $senha, $imagemID)) {
                        $_SESSION['imagem'] = $imagemID;
                        Painel::alert('sucesso', 'Informações atualizadas com sucesso!<br> <strong>ATUALIZE A PÁGINA PARA VER AS ALTERAÇÕES</strong>');
                        // Redirecionar para recarregar a página
                        header('Location: http://localhost/PLANO%20DE%20ESTUDOS/BACK-END/ESTUDOS/PROJETOS/SITE-DINAMICO/painel/editar-usuario');
                        die();
                    } else {
                        Painel::alert('erro', 'Falha ao atualizar as informações!');
                    }
                } else {
                    Painel::alert('erro', 'O formato da imagem não é válido!');
                }
            } else {
                if ($usuario->atualizarUsuario($nome, $senha, $imagemDB)) {
                    Painel::alert('sucesso', 'Informações atualizadas com sucesso!');
                } else {
                    Painel::alert('erro', 'Falha ao atualizar as informações!');
                }
            }
        }
        ?>

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input id="nome" type="text" name="nome" required autofocus placeholder="Alterar nome" value="<?php if (isset($_SESSION['nome'])) echo $_SESSION['nome'] ?>">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input id="senha" type="password" name="password" placeholder="Alterar senha" value="<?php if (isset($_SESSION['password'])) echo $_SESSION['password'] ?>">
        </div>
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input id="imagem" name="imagem" type="file" value="Escolha um arquivo">
            <input type="hidden" name="imagemDB">
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">
        </div>
    </form>
</div>