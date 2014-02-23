/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    var page = $('input#page').val();
    
    set_menuOn(page);
    if (page === 'policy'){
        $('.info_main').addClass('policy_main');
    }
});
