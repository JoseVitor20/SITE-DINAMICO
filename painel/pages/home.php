<?php

$usuariosOnline = Painel::listarUsuariosOnline();

// Obter total de visítas
$pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM tb_adminvisitas");
$pegarVisitasTotais->execute();
$pegarVisitasTotais = $pegarVisitasTotais->rowCount();

// Obter total de visítas hoje
$pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM tb_adminvisitas WHERE dia = ?");
$pegarVisitasHoje->execute([date('Y-m-d')]);
$pegarVisitasHoje = $pegarVisitasHoje->rowCount();

?>

<div class="box-content w100">
    <h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA; ?></h2>
    <div class="box-metricas">
        <div class="box-metricas-single">
            <div class="box-metrica-wrapper">
                <h2>Usuários Online</h2>
                <p><?php echo count($usuariosOnline) ?></p>
            </div>
        </div>
        <div class="box-metricas-single">
            <div class="box-metrica-wrapper">
                <h2>Total de visitas</h2>
                <p><?php echo $pegarVisitasTotais ?></p>
            </div>
        </div>
        <div class="box-metricas-single">
            <div class="box-metrica-wrapper">
                <h2>Visitas Hoje</h2>
                <p><?php echo $pegarVisitasHoje ?></p>
            </div>
        </div>
    </div>
</div>

<div class="box-content w100">
    <h2><i class="fas fa-user-gear"></i> Usuários do painel de controle</h2>

    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <h3><i class="fas fa-address-card"></i> Nome</h3>
            </div>
            <div class="col">
                <h3><i class="fas fa-user-clock"></i> Cargo</h3>
            </div>
            <div class="clear"></div>
        </div>

        <?php
        $usuariosPainel = MySql::conectar()->prepare("SELECT * FROM tb_adminusuario");
        $usuariosPainel->execute();
        $usuariosPainel = $usuariosPainel->fetchAll();
        foreach ($usuariosPainel as $key => $value) {

        ?>
            <div class="row">
                <div class="col">
                    <span><?php echo $value['user'] ?></span>
                </div>
                <div class="col">
                    <span><?php echo pegarCargo($value['cargo']) ?></span>
                </div>
                <div class="clear"></div>
            </div>
        <?php } ?>
    </div>

</div>

<div class="box-content w100">
    <h2><i class="fas fa-users"></i> Usuários Online no website</h2>

    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <h3><i class="fas fa-address-card"></i> IP</h3>
            </div>
            <div class="col">
                <h3><i class="fas fa-user-clock"></i> Última Ação</h3>
            </div>
            <div class="clear"></div>
        </div>

        <?php foreach ($usuariosOnline as $key => $value) { ?>
            <div class="row">
                <div class="col">
                    <span><?php echo $value['ip'] ?></span>
                </div>
                <div class="col">
                    <span><?php echo date('d/m/Y H:i:s', strtotime($value['ultima_acao'])) ?></span>
                </div>
                <div class="clear"></div>
            </div>
        <?php } ?>
    </div>

</div>