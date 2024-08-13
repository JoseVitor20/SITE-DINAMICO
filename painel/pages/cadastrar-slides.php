<div class="box-content">
    <h2><i class="fa fa-user"></i> Cadastrar novo slide</h2>

    <form method="post" enctype="multipart/form-data">

        <?php

        if (isset($_POST['acao'])) {
            $nome = $_POST['nome'];
            $imagem = $_FILES['imagem'];

            $usuario = new Usuarios();
            $formatoArquivo = explode('.', $imagem['name']);
            $extensao = end($formatoArquivo);
            $imagemID = uniqid() . '.' . $extensao;
            if ($nome == '') {
                Painel::alert('erro', 'O campo nome está vazio!');
            } elseif ($imagem['name'] == '') {
                Painel::alert('erro', 'Selecione uma imagem!');
            } else {
                if (Painel::imagemValida($imagem) == false) {
                    Painel::alert('erro', 'As dimensões ou tipo da imagem não é permitido!');
                } else {
                    $usuario = new Usuarios();
                    $imagem = Painel::uploadFileImg($imagem, $imagemID);
                    $arr = ['nome'=>$nome,'slide'=>$imagemID,'order_id'=>0,'nome_tabela'=>'tb_siteslides'];
                    Painel::insert($arr);
                    Painel::alert('sucesso', 'Novo slide cadastrado com sucesso!');
                }
            }
        }

        ?>

        <div class="form-group">
            <label for="nome">Nome do slide:</label>
            <input id="nome" type="text" name="nome" >
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