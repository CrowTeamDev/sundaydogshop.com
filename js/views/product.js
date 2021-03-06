$(function(){
    set_menuOn('shop');
    $('#main').addClass('productMode');
    set_shopOn($('input#gb').val());
    
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
    else{
        sortSize($("#dimention_detail"));
        sortSize($("#product_size"));
    }
    
    if ($('#product_price span').text() === "0"){
        sizeInvolve();
    }
    
    if ($('#product_size option:selected').attr('stock') !== ""){
        $('#productDetail #quantity').attr('max',$('#product_size option:selected').attr('stock'));
    }
    
    if ($('.product_color').size() > 0){
        if ($('.product_color').size() === 1)
            $('.product_color').addClass('show');
        $(".product_color[sizes='" + $('#product_size option:selected').text() + "']").addClass('show');
        $(".product_color").change(function(){
            $('#productDetail #quantity').attr('max',$('.product_color.show option:selected').attr('stock'));
            $('#productDetail #quantity').val(1);
        });
    }
    
    if ($('#product_size option').size() === 0){
        outOfStock();
    }
});

function buy(){
    var checkOut = $(this).attr('id') === "product_checkOut";
    var id = $("#product_id").val();
    var name = $("#product_name").text();
    var price = $("#product_price").find('span').text();
    var weight = $("#product_weight").val();
    var size = $("#product_size").val();
    var color = $(".product_color.show").val();
    var qty = $("#quantity").val();
    var stock = $("#quantity").attr('max');
    
    if (checkOut){
        $('header ul li#your_cart').click();
    }
    else{    
        if (size !== '' && color !== ''){
            var newDiv = $(document.createElement('div'));
            newDiv.html('<p id="popup_buy" align="center">you just added<br> '+ qty +' "'+ name +'"<br> to your cart </p>');
            newDiv.dialog({
                hide: ('fade', 750),
                show: ('fade', 750),
                modal: true,
                dialogClass: "no-close success-dialog",
                open: function(event, ui){
                    setTimeout(function(){
                        newDiv.dialog('close');
                    },750);
                }
            });
            $(".ui-dialog-titlebar").hide();

            name += ' (';
            name += $("#product_size>option:selected").html();
            if (color !== undefined)
                name += ', ' + color;
            name += ')';
            cart_obj.item.push(new Item(id, name, price, size, color, weight, qty, stock));

            var data = { cart : JSON.stringify(cart_obj) };
            $.post('view/_session.php', data);
            cartItem.add();
        }
    }
}

function changeToOneSize(){
    $("#product_size").attr("disabled", "disabled");
    if ($("#product_size option").text() === 'ONE'){
        $("#product_size").append($("<option></option>"));
        $("#product_size option").val("-");
        $("#product_size option").text("ONE SIZE");
    }
}

function sortSize(object){
    var options = object.children();
    options.sort(function (a, b) {
        var sizes = {
            "-- Please Select --":-1,
            "DL":0,
            "DM":1,
            "DS":2,
            "F":3,
            "XXL":4,
            "XL":5,
            "L":6,
            "M":7,
            "S":8,
            "XS":9,
            "XXS":10
        };

        var size_a = a.text === undefined ? sizes[a.id] : sizes[a.text];
        var size_b = b.text === undefined ? sizes[b.id] : sizes[b.text];
        
        if (size_a === size_b) {
            return 0;
        }
        return (size_a > size_b) ? 1 : -1;
    });
    object.append(options);
}

function sizeInvolve(){
    if ($('#product_size').val() !== null)
        $('#product_price span').text($('#product_size').val());
    else
        $('#product_price').text("");
    
    $('#product_size').change(function(){
        $('#product_price span').text($('#product_size').val());
        $('#product_weight').val($('#product_size option:selected').attr('weight'));
        
        if ($('#product_size option:selected').attr('stock') === ""){
            $(".product_color.show").removeClass('show');
            $(".product_color[sizes='" + $('#product_size option:selected').text() + "']").addClass('show');
            $(".product_color.show").val($(".product_color.show option:first").val());
            $('#productDetail #quantity').val(1);
        }else{
            $('#productDetail #quantity').attr('max',$('#product_size option:selected').attr('stock'));
            if ($('#productDetail #quantity').val() > $('#productDetail #quantity').attr('max')){
                $('#productDetail #quantity').val($('#productDetail #quantity').attr('max'));
            }
        }
    });
}

function outOfStock(){
    $('#product_stock').text("OUT OF STOCK");
    $('.inStock').remove();
}