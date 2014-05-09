/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    var page = $('input#page').val();
    var current_step = 0;
    var changingSlide;
    
    resumeSlide(changingSlide);
    
    if (window.location.pathname !== '/')
        set_menuOn(page);
    $('#main').addClass('homeMode');
    
    $('.arrow').click(function(){
        clearInterval(changingSlide);
        var next_step = $(this).attr('id') === "arrow_right" ? current_step+1 : current_step-1;
        gotoSlide(next_step);
        resumeSlide(changingSlide);
    });
    
    function gotoSlide(slide){
        if (!$('.home_main').is(':visible')) return;
        if (slide === -1) slide = $('.home_gallery', '.home_main').length;
        if (slide > $('.home_gallery', '.home_main').length) slide = 0;
        
        var hideDiv = $('div', '.home_main').eq(current_step);
        var showDiv = $('div', '.home_main').eq(slide);
        
        hideDiv.fadeOut(4000);
        showDiv.fadeIn(3500);
        
        current_step = slide;
    }
    function resumeSlide(changing){
        changing = setInterval(function(){gotoSlide(current_step+1);}, 30000);
    }
});
