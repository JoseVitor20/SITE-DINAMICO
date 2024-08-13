"use strict";

$(function () {
  var open = true;
  var menu = $('.menu');
  var header = $('header');
  var content = $('.content');
  var boxUsuario = $('.menu-wrapper');
  $('.menu-btn').click(function () {
    if (open) {
      menu.animate({
        width: 0
      }, function () {
        $(this).hide();
      });
      header.animate({
        left: 0,
        width: '100%'
      });
      content.animate({
        left: 0,
        width: '100%'
      });
      boxUsuario.hide().animate({
        display: 'none'
      });
    } else {
      menu.show().animate({
        width: '20%'
      });
      header.animate({
        left: '20%',
        width: '80%'
      });
      content.animate({
        left: '20%',
        width: '80%'
      });
      boxUsuario.show().animate({
        display: 'block'
      });
    }

    open = !open;
  });
  window.addEventListener('resize', function () {
    if ($(window)[0].innerWidth <= 768) {
      menu.animate({
        width: 0
      }, function () {
        $(this).hide();
      });
      header.animate({
        left: 0,
        width: '100%'
      });
      content.animate({
        left: 0,
        width: '100%'
      });
      boxUsuario.hide().animate({
        display: 'none'
      });
    } else {
      menu.show().animate({
        width: '20%'
      });
      header.animate({
        left: '20%',
        width: '80%'
      });
      content.animate({
        left: '20%',
        width: '80%'
      });
      boxUsuario.show().animate({
        display: 'block'
      });
    }
  });
  $('[actionBtn=delete]').click(function () {
    var txt;
    var r = confirm("Você deseja realmente excluir esse depoimento?");

    if (r == true) {
      txt = "Exclusão concluída!";
      return true;
    } else {
      txt = "Exclusão cancelada!";
      return false;
    }
  });
});