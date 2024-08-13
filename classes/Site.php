<?php

class Site
{
    public static function updateUsuarioOnline()
    {
        if (isset($_SESSION['on-line'])) {
            $token = $_SESSION['on-line'];
            $horarioAtual = date('Y-m-d H:i:s');
            $check = MySql::Conectar()->prepare("SELECT id FROM tb_adminonline WHERE token = ?");
            $check->execute([$_SESSION['on-line']]);

            if ($check->rowCount() == 1) {
                $sql = MySql::conectar()->prepare("UPDATE tb_adminonline SET ultima_acao=? WHERE token = ?");
                $sql->execute([$horarioAtual, $token]);
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
                $token = $_SESSION['on-line'];
                $horarioAtual = date('Y-m-d H:i:s');
                $sql = MySql::Conectar()->prepare("INSERT INTO tb_adminonline VALUES (null,?,?,?)");
                $sql->execute([$ip, $horarioAtual, $token]);
            }
        } else {
            $_SESSION['on-line'] = uniqid();
            $ip = $_SERVER['REMOTE_ADDR'];
            $token = $_SESSION['on-line'];
            $horarioAtual = date('Y-m-d H:i:s');
            $sql = MySql::Conectar()->prepare("INSERT INTO tb_adminonline VALUES (null,?,?,?)");
            $sql->execute([$ip, $horarioAtual, $token]);
        }
    }

    public static function contador()
    {
        $sql = MySql::conectar()->prepare("SELECT * FROM tb_adminvisitas");
        if (!isset($_COOKIE['visitas']) && $sql->rowCount() == 0) {
            setcookie('visitas', true, time() + (60 * 60 * 24 * 30));
            $sql = MySql::conectar()->prepare("INSERT INTO tb_adminvisitas VALUES (null,?,?)");
            $sql->execute([$_SERVER['REMOTE_ADDR'], date('Y-m-d')]);
        } else {
            $sql = MySql::conectar()->prepare("UPDATE tb_adminvisitas SET dia = ? WHERE dia = ?");
            $sql->execute([date('Y-m-d'), date('Y-m-d')]);
        }
    }
}
