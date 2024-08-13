<?php

verificarPermissaoPagina(2);
?>


<div class="box-content">
    <h2><i class="fa fa-user"></i> Adicionar novo usuário</h2>

    <form method="post" enctype="multipart/form-data">

        <?php

        if (isset($_POST['acao'])) {
            $login = $_POST['login'];
            $nome = $_POST['nome'];
            $senha = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $cargo = $_POST['cargo'];
            $usuario = new Usuarios();
            $formatoArquivo = explode('.', $imagem['name']);
            $extensao = end($formatoArquivo);
            $imagemID = uniqid() . '.' . $extensao;
            if ($login == '') {
                Painel::alert('erro', 'O campo usuário está vazio!');
            } elseif ($nome == '') {
                Painel::alert('erro', 'O campo nome está vazio!');
            } elseif ($senha == '') {
                Painel::alert('erro', 'O campo senha está vazio!');
            } elseif ($cargo == '') {
                Painel::alert('erro', 'Selecione uma opção!');
            } elseif ($imagem['name'] == '') {
                Painel::alert('erro', 'Selecione uma imagem!');
            } else {
                if ($cargo >= Painel::$cargos[2]) {
                    Painel::alert('erro', 'Selecione um cargo inferior ao selecionado!');
                } elseif (Painel::imagemValida($imagem) == false) {
                    Painel::alert('erro', 'As dimensões ou tipo da imagem não é permitido!');
                } elseif (Usuarios::userExists($login)) {
                    Painel::alert('erro', 'O usuário já existe!');
                } else {
                    $imagem = Painel::uploadFile($imagem, $imagemID);
                    $usuario = new Usuarios();
                    $usuario->cadastrarUsuario($login, $senha, $imagemID, $nome, $cargo);
                    Painel::alert('sucesso', 'Novo usuário cadastrado com sucesso!');
                }
            }
        }

        ?>

        <div class="form-group">
            <label for="nome">Usuário:</label>
            <input id="nome" type="text" name="login" value="Maria" autofocus placeholder="Digite o nome de usuário">
        </div>
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input id="nome" type="text" name="nome" value="Maria Letícia" autofocus placeholder="Digite seu nome">
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input id="senha" type="password" name="password" value="admin" placeholder="Digite a senha">
        </div>
        <div class="form-group">
            <label for="senha">Cargo:</label>
            <select name="cargo">
                <?php
                foreach (Painel::$cargos as $key => $value) {
                    if ($key != 2) echo "<option value=$key>$value</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input id="imagem" name="imagem" type="file">
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Novo usuário">
        </div>
    </form>
</div>