$(function(){
    set_menuOn('shop');
    $('#main').addClass('productMode');
    set_shopOn($('input#gb').val(), $("#product_name").text(), $("#product_id").val());
    
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
    $("#product_checkOut", "#productDetail").bind("click", buy);
    
    if ($("#product_size option").size() === 1)
        changeToOneSize();
    
    if ($('#product_price span').text() === "0")
        sizeInvolve();
});

function buy(){
    var checkOut = $(this).attr('id') === "product_checkOut";
    var id = $("#product_id").val();
    var name = $("#product_name").text();
    var price = $("#product_price").find('span').text();
    var weight = $("#product_weight").val();
    var size = $("#product_size").val();
    var color = $("#product_color").val();
    var qty = $("#quantity").val();
    
    if (checkOut){
        $('header ul li#your_cart').click();
    }
        
    if (size !== '' && color !== ''){
        var newDiv = $(document.createElement('div'));
        newDiv.html('<p id="popup_buy" align="center">you just added<br> '+ qty +' "'+ name +'"<br> to your cart </p>');
        newDiv.dialog({
            hide: ('fade', 3000),
            show: ('fade', 3000),
            modal: true,
            dialogClass: "no-close success-dialog",
            open: function(event, ui){
                setTimeout(function(){
                    newDiv.dialog('close');
                },5000);
            }
        });
        $(".ui-dialog-titlebar").hide();
        
        name += ' (';
        name += $("#product_size>option:selected").html();
        if (color !== undefined)
            name += ', ' + color;
        name += ')';
        cart_obj.item.push(new Item(id, name, price, size, color, weight, qty));
        
        var data = { cart : JSON.stringify(cart_obj) };
        $.post('view/_session.php', data);
        cartItem.add();
    }
}

function changeToOneSize(){
    $("#product_size option").val("-");
    $("#product_size option").text("ONE SIZE");
    $("#product_size").attr("disabled", "disabled");
}

function sizeInvolve(){
    $('#product_price span').text('?');
    $('#product_size').change(function(){
        $('#product_price span').text(
            $('#product_size').val() === '' ? '?' : $('#product_size').val()
        );
        $('#product_weight').val(
            $('#product_size').val() === '' ? '0' : $('#product_size option:selected').attr('weight')
        );
    });
}