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
        $('div[id*=contact_]').find('label').click(function(){
            $(this).parent().find('div').show();
        });
    }
});
