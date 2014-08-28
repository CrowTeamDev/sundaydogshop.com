/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    var page = $('input#page').val();
    var current_step = 0;
    var changingSlide;
    
    if (window.location.pathname !== '/')
        set_menuOn(page);
    $('#main').addClass('homeMode');
    $('#home_ribbon').addClass('home_ribbon0');
    
    $('.arrow').click(function(){
        clearInterval(changingSlide);
        var next_step = $(this).attr('id') === "arrow_right" ? current_step+1 : current_step-1;
        gotoSlide(next_step);
        changeBgTransparent();
        resumeSlide();
    });
    
    setTimeout(resumeSlide(), 7000);
    
    function gotoSlide(slide){
        if (!$('.home_main').is(':visible')) return;
        if (slide === -1) slide = $('.home_gallery', '.home_main').length;
        if (slide > $('.home_gallery', '.home_main').length) slide = 0;
        
        var hideDiv = $('div', '.home_main').eq(current_step);
        var showDiv = $('div', '.home_main').eq(slide);
        
        hideDiv.fadeOut(2000);
        showDiv.fadeIn(1700);
        
        $('#home_ribbon').fadeOut(1000, function(){
            $('#home_ribbon').removeClass();
            $('#home_ribbon').addClass('home_ribbon' + slide);
            $('#home_ribbon').fadeIn(1000);
        });
        
        current_step = slide;
    }
    function changeBgTransparent(){
        if (current_step === 0){
            $('.home_main').addClass('white');
            $('.home_main').removeClass('transparent');
        }
        else if (!$('.home_main').hasClass('transparent')){
            $('.home_main').addClass('transparent');
            $('.home_main').removeClass('white');
        }
    }
    function resumeSlide(){
        changingSlide = setInterval(function(){
            gotoSlide(current_step+1);
            changeBgTransparent();
        }, 7000);
    }
});
