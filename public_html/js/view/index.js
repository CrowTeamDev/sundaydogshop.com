/* 
 * index.js
 * 
 * Control every front-end process on index.html
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
        $("footer").hide();
        
        itemInYourCart(0);
        currentDirectory("HOME");
        changeBackground("init");
    }
    
    function setup_eventHandle(){
        $("header:eq(0)").click(function(){
            $(this).hide();
            $("#top_menu").show();
            $("#navigation_bar").show();
            $("footer").show();
        });
        $("header ul li").click(function(){
            var menu_no = $("li", $(this).parent()).index(this);
            var menu_id = $(this).attr("id") !== undefined ? 
                            $(this).attr("id") : 
                            "menu_" + menu_no ;
            
            changeBackground(menu_id);
            menu_handle(menu_id);
        });
    }
    
    function menu_handle(id){
        var url_redirect;
        switch(id){
            case "your_cart":
                url_redirect = "view/_payment.html";
                break;
            case "menu_0":
                break;
            case "menu_1":
                break;
            case "menu_2":
                break;
            case "menu_3":
                break;
            case "menu_4":
                break;
            case "menu_5":
                break;
        }
        $("#main").fadeOut(300, function(){
            $(this).load(url_redirect, function(){
                $(this).fadeIn(500);
            });
        });
    }
    
    function changeBackground(menu_id){
        var value;
        var div1_show = $("#background_1").css("display");
        
        switch (menu_id){
            case "init":
                value = 'url(content/image/background/image_2.jpg)';
                break;
            case "menu_4":
                value = 'url(content/image/background/image_1.jpg)';
                break;
            default:
                value = '#DED9CC';
                break;
        }
        
        if (div1_show === "none"){
            $("#background_1").css({'background': value, 'z-index':-2}).show();
            $("#background_2").css('z-index',-1).fadeOut(1000);
        }
        else{
            $("#background_2").css({'background': value, 'z-index':-2}).show();
            $("#background_1").css('z-index',-1).fadeOut(1000);
        }
    }
});
