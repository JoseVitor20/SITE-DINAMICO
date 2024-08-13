<?php

// Painel de controle Início 2/??
session_start();
date_default_timezone_set('America/Sao_Paulo');

// Painel de controle Fim 2/??

// Implementando PHPMailer Início 1/??
$autoload = function ($class) {
    if ($class == 'Email') {
        require_once('classes/vendor/autoload.php');
    }
    include('classes/' . $class . '.php');
};

spl_autoload_register($autoload);
// Implementando PHPMailer Fim 1/??

// Painel de controle Início 3/??
define('INCLUDE_PATH_PAINEL', 'http://localhost/SITE-DINAMICO/painel/');
// Painel de controle Fim 3/??


// Definindo o caminho padão da URL 
define('INCLUDE_PATH', 'http://localhost/SITE-DINAMICO/');

// Painel de controle Início 4/??
define('HOST', 'localhost');
define('DATABASE', 'projeto_01');
define('USER', 'JoseVitor');
define('PASSWORD', 'Jose Cross14k');
// Painel de controle Fim 4/??

// Constantes para o painel de controle
define('NOME_EMPRESA', 'José Vitor');

// Funções
function pegarCargo($indice)
{
    return Painel::$cargos[$indice];
}


function selecionadoMenu($par)
{
    $url = isset($_GET['url']) ? $_GET['url'] : '';
    if ($url == $par) {
        echo "class='menu-active'";
    }
}

function verificarPermissaoMenu($permissao)
{
    if ($_SESSION['cargo'] >= $permissao) {
        echo 'style="display: block;"';
    } else {
        echo 'style="display: none;"';
    }
}

function verificarPermissaoPagina($permissaoNegada)
{
    if ($_SESSION['cargo'] >= $permissaoNegada) {
        return;
    } else {
        include('painel/pages/permissao_negada.php');
        exit();
    }
}
