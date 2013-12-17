/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    //setup_variable();
    setup_default();
    setup_eventHandle();
    
    function setup_default(){
        set_menuOn('contact');
    }
    
    function setup_eventHandle(){
        $('div[id*=contact_]').children('label').click(function(){
            $('div[id*=contact_]').find('.show')
                    .removeClass('show')
                    .parent('div')
                        .addClass('unselect')
                        .removeClass('selected');
            $(this).parent('div').removeClass('unselect');
            $(this).next('div').addClass('show');
        });
        $('div#contact_FAQ').children('label').click(function(){
            $(this).parent('div').addClass('selected');
        });
        $('#contact_FAQ div').children('label').click(function(){
            $('#contact_FAQ div').find('.show')
                    .removeClass('show')
                    .parent('div')
                        .addClass('unselect')
                        .removeClass('selected');
            $(this).parent('div')
                    .removeClass('unselect')
                    .addClass('selected');
            $(this).next('div').addClass('show');
        });
        $('div#contact_mail').find('span').click(function(){
            $(this).closest('form').submit();
        });
    }
});
