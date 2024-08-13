// Implementando PHPMailer Início 3/??
// Formulário da página home.php
var include_path = $('base').attr('base');
$('body').on('submit', 'form', function () {
    var form = $(this);
    $.ajax({
        beforeSend: function () {
            $('.overlay-loading').fadeIn();
        },
        url: include_path + 'ajax/formularios.php',
        method: 'post',
        dataType: 'json',
        data: form.serialize()
    }).done(function (data) {
        if (data.sucesso) {
            $('.overlay-loading').fadeOut();
            $('.sucesso').fadeIn();
            setTimeout(function () {
                $('.sucesso').fadeOut()
            }, 3000)
        }else if(data.erro) {
            $('.overlay-loading').fadeOut();
            $('.falha').fadeIn();
            setTimeout(function () {
                $('.falha').fadeOut()
            }, 3000)
        }
    });
    return false;
})
// Implementando PHPMailer Fim 3/??