/* 
 * index.js
 * 
 * Control every front-end process on index.html
 */

$(document).ready(function(){
    
    var itemInYourCart;
    var currentDirectory;
    var ribbonOn;
    
    //Mock cart
        cart_obj = new Cart();
        cart_obj.item[0] = new Item('P001', 'Product 01', 500, 5);
        cart_obj.item[1] = new Item('P002', 'Product 02', 350, 3.5);
        cart_obj.item[2] = new Item('P003', 'Product 03', 150, 1.5);
    //
    
    setup_variable();
    setup_default();
    setup_eventHandle();
    
    function setup_variable(){
        itemInYourCart = {
            set : function(value){ $('span', '#your_cart').text(value); }
        };
        currentDirectory = {
            default: 'HOME',
            get: function(){ return $('#current_directory').text(); },
            add: function(value){
                var path = this.get() + '/' + value;
                $('#current_directory').text(path);
            },
            reset: function(value){
                var path;
                if(value === this.default || value === null)
                    path = this.default;
                else
                    path = this.default + '/' + value;
                $('#current_directory').text(path);
            }
        };
    }
    
    function setup_default(){
        $('#start_menu').slideDown(650, function(){
            $(this).find('label').fadeIn(450);
        });
        
        itemInYourCart.set(0);
        changeBackground('init');
    }
    
    function setup_eventHandle(){
        $('#start_menu').click(function(){
            $(this).fadeOut(300, function(){
                $('#navigation_bar, #top_menu, footer').fadeIn(500);
            });
        });
        $('#navigation_bar')
            .mouseout(function(){
                setRibbon(ribbonOn, true);
            })
            .find('li').mouseover(function(){
                setRibbon(ribbonOn, false);
            });
        $('header ul li').click(function(){
            var menu_no = $('li', $(this).parent()).index(this);
            var menu_id = $(this).attr('id') !== undefined ? 
                            $(this).attr('id') : 
                            'menu_' + menu_no ;
            var menu_name = $(this).attr('id') !== undefined ?
                            $(this).attr('id') :
                            $(this).text() ;

            currentDirectory.reset(menu_name);
            setRibbon(ribbonOn, false);
            ribbonOn = $(this).attr('id') === undefined ?
                        menu_no : null ;

            changeBackground(menu_id);
            menu_handle(menu_id);
        });
        $('#main').scroll(function(){
            var position_scrolling = $(this).scrollTop();
            $('#logo_rope').width(position_scrolling);
        });
        
        function setRibbon(menu_no, status){
            var menuSelected = '#navigation_bar ul li:eq('+menu_no+')';
            
            if(status)
                $(menuSelected).addClass('selected');
            else
                $(menuSelected).removeClass('selected');
        }
    }
    
    function menu_handle(id){
        var url_redirect;
        var main_width = $('#main').width();
        switch(id){
            case 'your_cart':
                url_redirect = 'view/_payment.html';
                main_width += 100;
                break;
            case 'menu_0':
                break;
            case 'menu_1':
                break;
            case 'menu_2':
                break;
            case 'menu_3':
                break;
            case 'menu_4':
                break;
            case 'menu_5':
                break;
        }
        $('#main').fadeOut(300, function(){
            $(this).width(main_width);
            $(this).load(url_redirect, function(){
                $(this).fadeIn(500);
            });
        });
    }
    
    function changeBackground(menu_id){
        var value;
        var div1_show = $('#background_1').css('display');
        
        switch (menu_id){
            case 'init':
                value = 'url(content/image/background/image_2.jpg)';
                break;
            case 'menu_4':
                value = 'url(content/image/background/image_1.jpg)';
                break;
            default:
                value = '#DED9CC';
                break;
        }
        
        if (div1_show === 'none'){
            $('#background_1').css({'background': value, 'z-index':-2}).show();
            $('#background_2').css('z-index',-1).fadeOut(1000);
        }
        else{
            $('#background_2').css({'background': value, 'z-index':-2}).show();
            $('#background_1').css('z-index',-1).fadeOut(1000);
        }
    }
});
