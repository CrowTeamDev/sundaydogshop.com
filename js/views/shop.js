/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function(){
    $('#start_menu').hide();
    $('#top_menu').show();
    $('#navigation_bar').show();
    $('#navigation_bar ul li:eq(1)').addClass('selected');
    
    $('#navigation_bar')
        .mouseout(function(){
            $('#navigation_bar ul li:eq(1)').addClass('selected');
        })
        .find('li').mouseover(function(){
            $('#navigation_bar ul li:eq(1)').removeClass('selected');
        });
});