$(function(){
    set_menuOn('shop');
    shop_handle($('input#gb').val());
    
    $(".productImage").elevateZoom({
        gallery: 'productImage',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
        zoomWindowPosition: 'zoomBox',
        loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'
    }); 
    $(".productImage").bind("click", function(e) {
        var ez = $('.productImage').data('elevateZoom');	
        $.fancybox(ez.getGalleryList());
        return false;
    });
    $(".thumbnail a").bind("click", function(e) {
        setTimeout(function(){
            $(".productImage").css({'width':'406px','height':'406px'});
        }, 50);
    });
    $("#product_buy", "#productDetail").bind("click", buy);
});

function buy(){
    var id = $("#product_id").val();
    var name = $("#product_name").text();
    var price = $("#product_price").find('span').text();
    var weight = $("#product_weight").val();
    var size = $("#product_size").val();
    var qty = $("#quantity").val();
    var newDiv = $(document.createElement('div'));
    if (size !== ''){
        newDiv.html('<p align="center">you just added<br> '+ qty +' "'+ name +'"<br> to your cart </p>');
        newDiv.dialog({
            hide: ('fade', 3000),
            show: ('fade', 3000),
            modal: true,
            dialogClass: "no-close success-dialog",
            open: function(event, ui){
                setTimeout(newDiv.dialog('close'),5000);
            }
        });
        $(".ui-dialog-titlebar").hide();
        
        cart_obj.item.push(new Item(id, name, price, weight, qty));
        
        var data = { cart : JSON.stringify(cart_obj) };
        $.post('view/_session.php', data);
        cartItem.add();
    }
}