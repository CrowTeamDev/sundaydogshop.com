/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    set_menuOn('shop');
    
    $('.product').mouseover(function(){
       $('.product_detail').hide();
       $(this).find('.product_detail').show();
    });
    $('.product').mouseout(function(){
       $('.product_detail').hide();
    });
});