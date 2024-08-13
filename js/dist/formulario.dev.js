"use strict";

var include_path = $('base').attr('base');
$('body').on('submit', 'form', function () {
  var form = $(this);
  $.ajax({
    beforeSend: function beforeSend() {
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
        $('.sucesso').fadeOut();
      }, 3000);
    } else if (data.erro) {
      $('.overlay-loading').fadeOut();
      $('.falha').fadeIn();
      setTimeout(function () {
        $('.falha').fadeOut();
      }, 3000);
    }
  });
  return false;
});