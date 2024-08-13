<?php

include('../config.php');

$data = [];

$assunto = 'Nova mensagem do site!';
$corpo = '';
foreach ($_POST as $key => $value) {
    $corpo .= ucfirst($key) . ": " . $value;
    $corpo .= "<hr>";
}
$info = ['assunto' => $assunto, 'corpo' => $corpo];
$mail = new Email('smtp.gmail.com', 'josevitordonascimentolopes@gmail.com', 'alzspepcbenyylox', 'José Vitor');
$mail->addAdress('josevitordonascimentolopes@gmail.com', 'Novo Email!');
$mail->formatarEmail($info);
if (strstr($_POST['email'],'@gmail.com',true)) {
    $mail->enviarEmail();
    $data['sucesso'] = true;
} else {
    $data['erro'] = true;
}


$data['retorno'] = 'sucesso';

die(json_encode($data));
