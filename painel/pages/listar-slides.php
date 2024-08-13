<?php
if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);

    $selectImagem = MySql::conectar()->prepare("SELECT slides FROM tb_siteslides WHERE id = ?");
    $selectImagem->execute([$_GET['excluir']]);
    $imagem = $selectImagem->fetch()['slides'];
    Painel::deleteFileIMG($imagem);
    Painel::deletar('tb_siteslides', $idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL . 'listar-slides');
} else if (isset($_GET['order'])) {
    Painel::orderItem('tb_siteslides', $_GET['order'], $_GET['id']);
}

$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 3;
$start = ($paginaAtual - 1) * $porPagina;

$slides = Painel::selectAll('tb_siteslides', $start, $porPagina);
?>

<div class="box-content">
    <h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Slides Cadastrados</h2>
    <div class="wrapper-table">
        <table>
            <tr>
                <td><i class="fas fa-file-signature"></i> Nome:</td>
                <td> <i class="fas fa-image"></i> Imagem:</td>
                <td><i class="fas fa-pen"></i> Edição:</td>
                <td><i class="fas fa-bomb"></i>Exclusão :</td>
                <td><i class="fas fa-angle-up"></i> Topo</td>
                <td><i class="fas fa-angle-down"></i> Ultimo</td>

            </tr>

            <?php foreach ($slides as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['nome'] ?></td>
                    <td><img style="width:100px" src="<?php INCLUDE_PATH_PAINEL ?>uploads/slide/<?php echo $value['slides'] ?>" alt=""></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>editar-slide?id=<?php echo $value['id'] ?>">Editar slide</a></td>
                    <td><a actionBtn="delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?excluir=<?php echo $value['id']; ?>">Excluir slide</a></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?order=up&id=<?php echo $value['id'] ?>"><i class="fas fa-angle-up"></a></i></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-slides?order=down&id=<?php echo $value['id'] ?>"><i class="fas fa-angle-down"></a></i></td>
                </tr>
            <?php } ?>

        </table>
    </div>
    <div class="paginacao">

        <?php
        $totalPaginas = ceil(count(Painel::selectAll('tb_siteslides')) / $porPagina);
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaAtual) {
                echo '<a class="pag-selected" href="' . INCLUDE_PATH_PAINEL . 'listar-slides?pagina=' . $i . '">' . $i . '</a>';
            } else {
                echo '<a href="' . INCLUDE_PATH_PAINEL . 'listar-slides?pagina=' . $i . '">' . $i . '</a>';
            }
        }

        ?>

    </div>
</div>