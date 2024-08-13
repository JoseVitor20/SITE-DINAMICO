<?php

class Painel
{

    public static $cargos = [
        '0' => 'Normal',
        '1' => 'Sub Administrador',
        '2' => 'Administrador'
    ];

    public static function logado()
    {
        return isset($_SESSION['login']) ? true : false;
    }

    public static function logout()
    {
        session_destroy();
        setcookie('lembrar', 'true', time() - 1, '/');
        setcookie('user', '', time() - 1, '/');
        setcookie('password', '', time() - 1, '/');
        header('Location: ' . INCLUDE_PATH_PAINEL);
        exit();
    }

    public static function carregarPagina()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
            if (file_exists('pages/' . $url . '.php')) {
                include('pages/' . $url . '.php');
            } else {
                echo "<script>location.href=" . INCLUDE_PATH_PAINEL . "</script>";
                exit();
            }
        } else {
            include('pages/home.php');
        }
    }

    public static function listarUsuariosOnline()
    {
        self::limparUsuarioOnline();
        $sql = MySql::conectar()->prepare("SELECT * FROM tb_adminonline");
        $sql->execute();
        return $sql->fetchAll();
    }

    public static function limparUsuarioOnline()
    {
        $date = date('Y-m-d H:i:s');
        $sql = MySql::conectar()->exec("DELETE FROM tb_adminonline WHERE ultima_acao < '$date' - INTERVAL 1 MINUTE");
    }

    public static function alert($tipo, $mensagem)
    {
        if ($tipo == 'sucesso') {
            echo "<div class='sucesso'>
                <h2>✓ $mensagem</h2>
            </div>";
        } else {
            echo "<div class='erro'>
            <h2>X $mensagem</h2>
        </div>";
        }
    }

    public static function imagemValida($imagem)
    {
        switch ($imagem['type']) {
            case 'image/jpeg';
            case 'image/jpg';
            case 'image/png';
                $tamanho = intval($imagem['size'] / 1024);
                if ($tamanho < 500) return true;
                break;
            default;
                return false;
                break;
        }
    }

    public static function uploadFile($file, $fileID)
    {
        if (!file_exists("C:/wamp64/www/PLANO DE ESTUDOS/BACK-END/ESTUDOS/PROJETOS/SITE-DINAMICO/painel/uploads/$fileID")) {
            if (move_uploaded_file($file['tmp_name'], '../painel/uploads/' . $fileID)) {
                return $file;
            } else {
                return false;
            }
        }
    }
    

    public static function uploadFileImg($file, $fileID)
    {
        if (!file_exists("C:/wamp64/www/PLANO DE ESTUDOS/BACK-END/ESTUDOS/PROJETOS/SITE-DINAMICO/painel/uploads/slide/$fileID")) {
            if (move_uploaded_file($file['tmp_name'], '../painel/uploads/slide/' . $fileID)) {
                return $file;
            } else {
                return false;
            }
        }
    }

    public static function deleteFile($file)
    {
        if (empty($file)) {
            return;
        }

        $arquivo = strval($file);
        $path = "C:/wamp64/www/PLANO DE ESTUDOS/BACK-END/ESTUDOS/PROJETOS/SITE-DINAMICO/painel/uploads/$arquivo";

        // Verificar se o caminho é realmente um arquivo
        if (is_file($path)) {
            unlink($path);
        }
    }

    public static function deleteFileIMG($file)
    {
        if (empty($file)) {
            return;
        }

        $arquivo = strval($file);
        $path = "C:/wamp64/www/PLANO DE ESTUDOS/BACK-END/ESTUDOS/PROJETOS/SITE-DINAMICO/painel/uploads/slide/$arquivo";

        // Verificar se o caminho é realmente um arquivo
        if (is_file($path)) {
            unlink($path);
        }
    }

    public static function insert($arr)
    {
        $certo = true;
        $nome_tabela = $arr['nome_tabela'];
        $query = "INSERT INTO $nome_tabela VALUES (null";
        foreach ($arr as $key => $value) {
            $nome = $key;
            $valor = $value;
            if ($nome == 'acao' || $nome == 'nome_tabela') {
                continue;
            }
            if ($valor == '') {
                $certo = false;
                break;
            }
            $query .= ",?";
            $parametros[] = $valor;
        }
        $query .= ")";
        if ($certo == true) {
            $sql = MySql::conectar()->prepare($query);
            $sql->execute($parametros);
            $lastId = MySql::conectar()->lastInsertId();
            $sql = MySql::conectar()->prepare("UPDATE $nome_tabela SET order_id = ? WHERE id = $lastId");
            $sql->execute([$lastId]);
        }
        return $certo;
    }

    public static function selectAll($tabela, $start = null, $end = null)
    {
        if ($start === null && $end === null) {
            $sql = MySql::conectar()->prepare("SELECT * FROM $tabela ORDER BY order_id ASC");
            $sql->execute();
        } else {
            $sql = MySql::conectar()->prepare("SELECT * FROM $tabela ORDER BY order_id ASC LIMIT ?, ?");
            $sql->bindParam(1, $start, PDO::PARAM_INT);
            $sql->bindParam(2, $end, PDO::PARAM_INT);
            $sql->execute();
        }
        return $sql->fetchAll();
    }

    public static function deletar($tabela, $id = false)
    {
        if ($id == false) {
            $sql = MySql::conectar()->prepare("DELETE FROM $tabela");
        } else {
            $sql = MySql::conectar()->prepare("DELETE FROM $tabela WHERE id = $id");
        }
        $sql->execute();
    }

    public static function redirect($url)
    {
        echo '<script>location.href="' . $url . '"</script>';
        exit();
    }

    public static function select($table, $query, $arr='')
    {
        if($query != false){
            $sql = MySql::conectar()->prepare("SELECT * FROM $table WHERE $query");
            $sql->execute($arr);
        }else{
            $sql = MySql::conectar()->prepare("SELECT * FROM $table");
            $sql->execute();
        }
        return $sql->fetch();
    }

    public static function update($arr, $single = false)
    {
        $certo = true;
        $first = false;
        $nome_tabela = $arr['nome_tabela'];
        $query = "UPDATE $nome_tabela SET ";
        foreach ($arr as $key => $value) {
            $nome = $key;
            $valor = $value;
            if ($nome == 'acao' || $nome == 'nome_tabela' || $nome == 'id') {
                continue;
            }
            if ($valor == '') {
                $certo = false;
                break;
            }
            if ($first == false) {
                $first = true;
                $query .= "$nome=?";
            } else {
                $query .= ",$nome=?";
            }
            $parametros[] = $valor;
        }
        if ($certo == true) {
            if($single == true){
                $parametros[] = $arr['id'];
                $sql = MySql::conectar()->prepare($query . 'WHERE id=?');
                $sql->execute($parametros);
            }else{
                $sql = MySql::conectar()->prepare($query);
                $sql->execute($parametros);
            }
        }
        return $certo;
    }

    public static function orderItem($tabela, $orderType, $idItem)
    {
        if ($orderType == 'up') {
            $infoItemAtual = Painel::select($tabela, 'id=?', [$idItem]);
            $order_id = $infoItemAtual['order_id'];
            $itemBefore = MySql::conectar()->prepare("SELECT * FROM $tabela WHERE order_id < $order_id LIMIT 1");
            $itemBefore->execute();
            if ($itemBefore->rowCount() == 0) {
                return;
            }
            $itemBefore = $itemBefore->fetch();
            Painel::update(['nome_tabela' => $tabela, 'id' => $itemBefore['id'], 'order_id' => $infoItemAtual['order_id']]);
            Painel::update(['nome_tabela' => $tabela, 'id' => $infoItemAtual['id'], 'order_id' => $itemBefore['order_id']]);
        } else if ($orderType == 'down') {
            $infoItemAtual = Painel::select($tabela, 'id=?', [$idItem]);
            $order_id = $infoItemAtual['order_id'];
            $itemAfter = MySql::conectar()->prepare("SELECT * FROM $tabela WHERE order_id > $order_id ORDER BY id DESC LIMIT 1");
            $itemAfter->execute();
            if ($itemAfter->rowCount() == 0) {
                return;
            }
            $itemAfter = $itemAfter->fetch();
            Painel::update(['nome_tabela' => $tabela, 'id' => $itemAfter['id'], 'order_id' => $infoItemAtual['order_id']]);
            Painel::update(['nome_tabela' => $tabela, 'id' => $infoItemAtual['id'], 'order_id' => $itemAfter['order_id']]);
        }
    }
}
