/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    var page = $('input#page').val();
    
    if (window.location.pathname !== '/')
        set_menuOn(page);
});