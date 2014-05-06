/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    var page = $('input#page').val();
    var current_step = 0;
    
    if (window.location.pathname !== '/')
        set_menuOn(page);
    $('#main').addClass('homeMode');
    
    $('.arrow').click(function(){
        var side = $(this).attr('id');
        var next_step = side === "arrow_right" ? current_step+1 : current_step-1;
        if (next_step === -1) next_step = $('.home_gallery', '.home_main').length;
        if (next_step > $('.home_gallery', '.home_main').length) next_step = 0;
        
        var hideDiv = $('div', '.home_main').eq(current_step);
        var showDiv = $('div', '.home_main').eq(next_step);
        
        hideDiv.fadeOut(4000);
        showDiv.fadeIn(3500);
        
        current_step = next_step;
    });
});
