/* 
 * index.js
 * 
 * Control every front-end process on index.html
 */

//For debug
/*
$(document).keypress(function(event){
    if (String.fromCharCode(event.which) === 'z'){
        alert($('li.selected').attr('id'));
    } 
 });
 */


//public

var directory = {
    default: 'HOME',
    get: function(){ return $('#current_directory').text(); },
    add: function(value){
        var path = this.get() + '/' + value;
        $('#current_directory').text(path);
    },
    reset: function(value){
        var path = this.default + '/' + value.toUpperCase();
        $('#current_directory').text(path);
    }
};

cartItem = {
    set : function(value){ $('span', '#your_cart').text(value); },
    add : function(){
        var amount = parseInt($('span', '#your_cart').text())++;
        this.set(amount);
    }
};

function set_menuOn(menu_id){
    $('#start_menu').hide();
    $('#navigation_bar, #top_menu, footer').show();
 
    changeBackground(menu_id);
    directory.reset(menu_id);
    $('header ul li#'+menu_id).addClass('select');
}
function changeBackground(menu_id){
    var value;
    var url_path = $('#local_path').val();

    $('#background_1').show();
    switch (menu_id){
        case 'init':
            value = 'url('+ url_path + '/content/image/background/image_2.jpg)';
            break;
        case 'contact':
            value = 'url('+ url_path + '/content/image/background/image_3.jpg)';
            break;
        default:
            $('#background_1').hide();
            value = 'url('+ url_path + '/content/image/background/image_0.jpg)';
            break;
    }
    $('#background_2').css('background-image', value);
}
function shop_handle(menuSelected){
    $('#shop', '#navigation_bar #main_menu').addClass('selected shopMode');
    $('#sub_menu', '#navigation_bar').show();
    $('#'+menuSelected, '#navigation_bar #sub_menu').addClass('findOn');
}

//private

$(document).ready(function(){
    
    var url_path;
    
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
        url_path = $('#local_path').val();
    }
    
    function setup_default(){
        
        changeBackground('init');
        $('#start_menu').slideDown(650, function(){
            $(this).find('label').fadeIn(450);
        });
    }
    
    function setup_eventHandle(){
        $('#start_menu').click(function(){
            $(this).fadeOut(300, function(){
                $('#navigation_bar').addClass('page_load').fadeIn(2500);
                $('#top_menu, footer').addClass('page_load').fadeIn(500);
            });
        });
        $('#navigation_bar #main_menu').find('li').mouseover(function(){
            var selected = $('li.select');
            var shoped = $('li.shopMode');

            $(this).addClass('select');
            
            selected.removeClass('select');
            selected.addClass('selected');
            
            if(shoped !== null){
                shoped.removeClass('shopMode');
                shoped.addClass('shoped');
                $('#sub_menu', '#navigation_bar').hide();
            }
        });
        $('#navigation_bar #main_menu').find('li').mouseout(function(){
            var selected = $('li.selected');
            var shoped = $('li.shoped');

            $(this).removeClass('select');
            
            selected.removeClass('selected');
            selected.addClass('select');
            
            if(shoped.attr('id') === 'shop'){
                shoped.removeClass('shoped');
                shoped.addClass('shopMode');
                $('#sub_menu', '#navigation_bar').show();
            }
        });
        $('#navigation_bar #sub_menu').find('li').mouseover(function(){
            var selected = $('li.findOn');
            
            selected.removeClass('findOn');
            selected.addClass('wasOn');
        });
        $('#navigation_bar #sub_menu').find('li').mouseout(function(){
            var selected = $('li.wasOn');
            
            selected.removeClass('wasOn');
            selected.addClass('findOn');
        });
        $('header ul li').click(function(){
            var menu_id = $(this).attr('id');

            if(menu_id === 'shop'){
                $('li.selected').removeClass('selected');
                $(this).addClass('selected shopMode');
                $('#sub_menu', '#navigation_bar').slideDown(1200);
            }
            else if($(this).parent().attr('id') === 'sub_menu')
                shop_handle(menu_id);
            else
                menu_handle(menu_id);
        });
        $('#main').scroll(function(){
            var position_scrolling = $(this).scrollTop();
            $('#logo_rope').width(position_scrolling);
        });
    }
    
    function menu_handle(id){
        var url_redirect;
        switch(id){
            case 'your_cart':
                url_redirect = url_path + '/view/_payment.php';
                $('#main').addClass('paymentMode');
                break;
            default:
                window.location.href = id;
                break;
        }
        $('#main').fadeOut(300, function(){
            $(this).load(url_redirect, function(){
                $(this).fadeIn(500);
            });
        });
    }    
    function shop_handle(id){
        window.location.href = 'shop?gb=' + id;
    }
});