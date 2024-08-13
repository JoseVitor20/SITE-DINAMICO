<?php
if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_sitedepoimentos', $idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL . 'listar-depoimentos');
} else if (isset($_GET['order'])) {
    Painel::orderItem('tb_sitedepoimentos', $_GET['order'], $_GET['id']);
}


$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 3;
$start = ($paginaAtual - 1) * $porPagina;

$depoimentos = Painel::selectAll('tb_sitedepoimentos', $start, $porPagina);
?>

<div class="box-content">
    <h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Depoimentos Cadastrados</h2>
    <div class="wrapper-table">
        <table>
            <tr>
                <td><i class="fas fa-file-signature"></i> Nome:</td>
                <td> <i class="fas fa-align-left"></i> Depoimento:</td>
                <td> <i class="fas fa-clock"></i> Data:</td>
                <td><i class="fas fa-pen"></i> Edição:</td>
                <td><i class="fas fa-bomb"></i>Exclusão :</td>
                <td><i class="fas fa-angle-up"></i> Topo</td>
                <td><i class="fas fa-angle-down"></i> Ultimo</td>

            </tr>

            <?php foreach ($depoimentos as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['nome'] ?></td>
                    <td><?php echo $value['depoimento'] ?></td>
                    <td><?php echo $value['data'] ?></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>editar-depoimento?id=<?php echo $value['id'] ?>">Editar depoimento</a></td>
                    <td><a actionBtn="delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?excluir=<?php echo $value['id']; ?>">Excluir depoimento</a></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?order=up&id=<?php echo $value['id'] ?>"><i class="fas fa-angle-up"></a></i></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?order=down&id=<?php echo $value['id'] ?>"><i class="fas fa-angle-down"></a></i></td>
                </tr>
            <?php } ?>

        </table>
    </div>
    <div class="paginacao">

        <?php
        $totalPaginas = ceil(count(Painel::selectAll('tb_sitedepoimentos')) / $porPagina);
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaAtual) {
                echo '<a class="pag-selected" href="' . INCLUDE_PATH_PAINEL . 'listar-depoimentos?pagina=' . $i . '">' . $i . '</a>';
            } else {
                echo '<a href="' . INCLUDE_PATH_PAINEL . 'listar-depoimentos?pagina=' . $i . '">' . $i . '</a>';
            }
        }

        ?>

    </div>
</div>