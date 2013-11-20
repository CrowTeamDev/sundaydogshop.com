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
        changeBackground(0);
    }
    
    function setup_eventHandle(){
        $("header:eq(0)").click(function(){
            $(this).hide();
            $("#top_menu").show();
            $("#navigation_bar").show();
        });
        $("header ul li").click(function(){
            var menu_no = $("header ul li").index(this);
            
            changeBackground(menu_no);
            $("#main").show();
        });
    }
    
    function changeBackground(menu_no){
        var value;
        var div1_show = $("#background_1").css("display");
        
        switch (menu_no){
            case 1:
            case 2:
                value = 'url(content/image/background/image_1.jpg)';
                break;
            default:
                value = 'url(content/image/background/image_2.jpg)';
                break;
        }
        
        if (div1_show === "none"){
            $("#background_1").css({'background-image': value, 'z-index':-2}).show();
            $("#background_2").css('z-index',-1).fadeOut(1000);
        }
        else{
            $("#background_2").css({'background-image': value, 'z-index':-2}).show();
            $("#background_1").css('z-index',-1).fadeOut(1000);
        }
    }
});
