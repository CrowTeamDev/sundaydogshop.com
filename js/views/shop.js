$(function(){
    set_menuOn('shop');
    $('#main').addClass('shopMode');
    $('#shop_menu #shop_hover').mousemove(function(e){
        var parentOffset = $(this).parent().offset();
        var width = $(this).width();
        var height = $(this).height();
        
        var relX = (e.pageX - parentOffset.left)*100/width;
        var relY = (e.pageY - parentOffset.top)*100/height;
        
        var value;
        var url_path = $('#local_path').val();
        
        if (relX < 27 || relX > 73){
            $(this).removeClass('pointer');
            value = '';
        }
        else{
            $(this).addClass('pointer');
            if (relX < 50 && relY < 27) //eat
                value = 'url('+ url_path + '/content/image/shop_menu-eat.png)';
            else if (relX < 50 && relY < 49) //play
                value = 'url('+ url_path + '/content/image/shop_menu-play.png)';
            else if (relX < 50 && relY < 68) //sale
                value = 'url('+ url_path + '/content/image/shop_menu-sale.png)';
            else if (relX > 50 && relY < 22) //walk
                value = 'url('+ url_path + '/content/image/shop_menu-walk.png)';
            else if (relX > 50 && relY < 42) //wear
                value = 'url('+ url_path + '/content/image/shop_menu-wear.png)';
            else if (relX > 50 && relY < 68) //all
                value = 'url('+ url_path + '/content/image/shop_menu-all.png)';
            else
                value = 'url('+ url_path + '/content/image/shop_menu-sleep.png)';
        }
        
        $(this).css('background-image', value);
    });
    $('#shop_menu #shop_hover').click(function(e){
        var parentOffset = $(this).parent().offset();
        var width = $(this).width();
        var height = $(this).height();
        
        var relX = (e.pageX - parentOffset.left)*100/width;
        var relY = (e.pageY - parentOffset.top)*100/height;
        
        var url_path = window.location.href + '?gb=';
        
        if (relX < 27 || relX > 73) return;
        if (relX < 50 && relY < 27) //eat
            url_path += 'e';
        else if (relX < 50 && relY < 49) //play
            url_path += 'p';
        else if (relX < 50 && relY < 68) //sale
            url_path += 'sa';
        else if (relX > 50 && relY < 22) //walk
            url_path += 'wa';
        else if (relX > 50 && relY < 42) //wear
            url_path += 'we';
        else if (relX > 50 && relY < 68) //all
            url_path += 'a';
        else
            url_path += 's';
        
        window.location.href = url_path;
    });
});