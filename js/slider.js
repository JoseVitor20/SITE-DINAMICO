$(function(){
    var curSlide = 0;
    var maxSlide = $('.slide-img').length;
    var delay = 3;

    initSlide();
    changeSlide();

    function initSlide(){
        $('.slide-img').hide();
        $('.slide-img').eq(0).show();
        for(let i=0;i < maxSlide;i++){
            var content = $('.slide-bollets').html();
            if(i == 0){
                content+='<span class="active-slide"></span>';
            }else{
                content+='<span></span>';
                $('.slide-bollets').html(content);
            }
        }
    }

    function changeSlide(){
        setInterval(function(){
            $('.slide-img').eq(curSlide).stop().fadeOut(1000);
            curSlide++;
            if(curSlide > maxSlide-1){
                curSlide = 0;
            }
            $('.slide-img').eq(curSlide).stop().fadeIn(1000);
            $('.slide-bollets span').removeClass('active-slide')
            $('.slide-bollets span').eq(curSlide).addClass('active-slide')
        },delay * 1000)
    }


})