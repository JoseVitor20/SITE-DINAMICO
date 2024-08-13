<?php

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $slide = Painel::select('tb_siteslides', 'id=?', [$id]);
} else {
    Painel::alert('erro', 'Você precisa passar o parâmetro id');
    die();
}

?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Slide</h2>
    <form method="post" enctype="multipart/form-data">

        <?php
        if (isset($_POST['acao'])) {
            $usuario = new Usuarios();
            $nome = $_POST['nome'];
            $img = $_FILES['imagem'];

            $formatoArquivo = explode('.', $img['name']);
            $extensao = end($formatoArquivo);
            $imgID = uniqid() . '.' . $extensao;
            if ($img['name'] != '') {

                if (Painel::imagemValida($img)) {
                    Painel::deleteFileIMG($imgID);
                    $img = Painel::uploadFileImg($img, $imgID);                        
                    $arr = ['nome'=>$nome,'slides'=>$imgID,'id'=>$id,'nome_tabela'=>'tb_siteslides'];
                    Painel::update($arr);
                    echo "<script>location.href='http://localhost/PLANO%20DE%20ESTUDOS/BACK-END/ESTUDOS/PROJETOS/SITE-DINAMICO/painel/listar-slides'</script>";
                    die();
                } else {
                    Painel::alert('erro', 'O formato da imagem não é válido!');
                }
            }
        }
        ?>

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input id="nome" type="text" name="nome" required autofocus placeholder="Alterar nome" value="<?php echo $slide['nome']?>">
        </div>
        <div class="form-group">
            <label for="imagem">Imagem:</label>
            <input id="imagem" type="file" name="imagem">
            <input type="hidden" name="imgDB" value="<?php echo $slide['slides'] ?>">
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar">
        </div>
    </form>
</div>