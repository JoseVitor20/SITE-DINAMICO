<?php
if (isset($_GET['excluir'])) {
    $idExcluir = intval($_GET['excluir']);
    Painel::deletar('tb_siteservicos', $idExcluir);
    Painel::redirect(INCLUDE_PATH_PAINEL . 'listar-servicos');
} else if (isset($_GET['order'])) {
    Painel::orderItem('tb_siteservicos', $_GET['order'], $_GET['id']);
}


$paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$porPagina = 3;
$start = ($paginaAtual - 1) * $porPagina;

$servicos = Painel::selectAll('tb_siteservicos', $start, $porPagina);
?>

<div class="box-content">
    <h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Serviços Cadastrados</h2>
    <div class="wrapper-table">
        <table>
            <tr>
                <td><i class="fas fa-file-signature"></i> Serviço:</td>
                <td><i class="fas fa-pen"></i> Edição:</td>
                <td><i class="fas fa-bomb"></i>Exclusão :</td>
                <td><i class="fas fa-angle-up"></i> Topo</td>
                <td><i class="fas fa-angle-down"></i> Ultimo</td>

            </tr>

            <?php foreach ($servicos as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['servico'] ?></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>editar-servicos?id=<?php echo $value['id'] ?>">Editar serviço</a></td>
                    <td><a actionBtn="delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?excluir=<?php echo $value['id']; ?>">Excluir serviço</a></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=up&id=<?php echo $value['id'] ?>"><i class="fas fa-angle-up"></a></i></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos?order=down&id=<?php echo $value['id'] ?>"><i class="fas fa-angle-down"></a></i></td>
                </tr>
            <?php } ?>

        </table>
    </div>
    <div class="paginacao">

        <?php
        $totalPaginas = ceil(count(Painel::selectAll('tb_siteservicos')) / $porPagina);
        for ($i = 1; $i <= $totalPaginas; $i++) {
            if ($i == $paginaAtual) {
                echo '<a class="pag-selected" href="' . INCLUDE_PATH_PAINEL . 'listar-servicos?pagina=' . $i . '">' . $i . '</a>';
            } else {
                echo '<a href="' . INCLUDE_PATH_PAINEL . 'listar-servicos?pagina=' . $i . '">' . $i . '</a>';
            }
        }

        ?>

    </div>
</div>