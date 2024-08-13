<?php

include('../config.php');

// Painel de controle Início 4/??

if (Painel::logado() == false) {
    include('login.php');
} else {
    include('main.php');
}
// Painel de controle Fim 4/??
