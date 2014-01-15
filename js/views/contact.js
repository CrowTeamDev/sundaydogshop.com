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
                    .hide()
                    .parent('div')
                        .addClass('unselect')
                        .removeClass('selected');
            $(this).parent('div').removeClass('unselect');
            $(this).next('div').addClass('show').fadeIn(1750);
        });
        $('div#contact_FAQ').children('label').click(function(){
            $(this).parent('div').addClass('selected');
        });
        $('#contact_FAQ div').children('label').click(function(){
            $('#contact_FAQ div').find('.show')
                    .removeClass('show')
                    .hide()
                    .parent('div')
                        .addClass('unselect')
                        .removeClass('selected');
            $(this).parent('div')
                    .removeClass('unselect')
                    .addClass('selected');
            $(this).next('div').addClass('show').fadeIn(750);
        });
        $('div#contact_mail').find('span').click(function(){
            if(!validateInputs()) return;
            $(this).closest('form').submit();
        });
    }
    
    function validateInputs(){
        var row = function(i){ return $('tr:eq('+i+') td:eq(1)', 'div#contact_mail form').find('input,textarea'); };
        var result = -1;
        
        $('tr', 'div#contact_mail form').find('.error').removeClass('error');
        
        if (row(0).val() === ''){
            $('tr:eq(0)', 'div#contact_mail form').find('.label').addClass('error');
            result = false;
        }
        
        var mail = row(1).val();
        var atpos=mail.indexOf("@");
        var dotpos=mail.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=mail.length){
            $('tr:eq(1)', 'div#contact_mail form').find('.label').addClass('error');
            result = false;
        }
        
        if (row(2).val() === ''){
            $('tr:eq(2)', 'div#contact_mail form').find('.label').addClass('error');
            result = false;
        }
        
        if (row(3).val() === ''){
            $('tr:eq(3)', 'div#contact_mail form').find('.label').addClass('error');
            result = false;
        }
        
        return result;
    }
});
