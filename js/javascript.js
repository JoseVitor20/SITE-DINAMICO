// Menu Mobile
{
    $('nav.mobile').click(function () {
        var listaMenu = $('nav.mobile ul');
        var icone = $('.botao-menu-mobile').find('i');
        if (listaMenu.is(':hidden') == true) {
            icone.removeClass('fa-bars');
            icone.addClass('fa-times');
            listaMenu.slideToggle();
        } else {
            icone.removeClass('fa-times');
            icone.addClass('fa-bars');
            listaMenu.slideToggle();
        }
    })

}

// Scroll dinâmico com jQuery e PHP
{
    if ($('target').length > 0) {
        var elemento = '#' + $('target').attr('target');
        var divScroll = $(elemento).offset().top;
        $('html,body').animate({ 'scrollTop': divScroll},2000)
    }       
}
