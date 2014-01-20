$(function(){
    set_menuOn('shop');
    shop_handle($('input#gb').val());
    
    $(".productImage").elevateZoom({
        gallery: 'productImage',
        cursor: 'pointer',
        galleryActiveClass: 'active',
        imageCrossfade: true,
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
    var name = $("#product_name").text();
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
    }
}