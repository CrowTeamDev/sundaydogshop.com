/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    var itemInYourCart;
    var currentDirectory;
    
    setup_variable();
    setup_default();
    setup_eventHandle();
    
    function setup_variable(){
        itemInYourCart = 
            function(amountOfItem){ 
                $("span", "#your_cart").text(amountOfItem);
            };
        currentDirectory = 
            function(directory){ 
                $("#current_directory").text(directory);
            };
    }
    
    function setup_default(){
        $("#top_menu").hide();
        $("#navigation_bar").hide();
        $("#main").hide();
        
        itemInYourCart(0);
        currentDirectory("HOME");
    }
    
    function setup_eventHandle(){
        $("header:eq(0)").click(function(){
            $(this).hide();
            $("#top_menu").show();
            $("#navigation_bar").show();
        });
    }
});
