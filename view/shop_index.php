<script src="js/views/shopIndex.js" type="text/javascript"></script>
<script src="js/views/jquery.simplePagination.js"></script>
<script src="js/views/jquery.nicescroll.js"></script>
<link rel="stylesheet" type="text/css" href="css/shop.css" />
<input type="hidden" id="gb" value="<?=$groupBy?>"/>
<script>
    $(function(){
        $('input[type^="checkbox"]').click(function(){
            var brand = "";
            var color = "";
            var size = "";
             $('input[type=checkbox]').each(function(){
                 if($(this).attr("class") == 'brand'){
                     var sBrand = (this.checked ? this.id : "");
                      brand += (brand=="" ? sBrand : "," + sBrand);
                 }
                 if($(this).attr("class") == 'color'){
                     var sColor = (this.checked ? this.id : "");
                      color += (color=="" ? sColor : "," + sColor);
                 }
                 if($(this).attr("class") == 'size'){
                     var sSize = (this.checked ? this.id : "");
                      size += (size=="" ? sSize : "," + sSize);
                 }
             });
             $.ajax({
                url: "shop/productAjax",
                data: {
                    gb:$("#gb").val(),
                    brand: brand,
                    color:color,
                    size:size
                },
                success: function( data ) {
                    data = $(data).filter("#main").attr("id","");
                    jQuery("#main-content").fadeOut( 1100 , function() {
                        $("#main-content").html(data);
                    }).fadeIn( 1000 );
                }
             });
        });
        
        // Sidebar
    
        var sidebarResize = function(){
            $('#ob-sidebar-wrapper, #ob-sidebar').height($(window).height()-120-$("footer").outerHeight());
            $('#ob-sidebar').niceScroll().resize();
        };
        $('#ob-sidebar-wrapper, #ob-sidebar').height($(window).height()-120-$("footer").outerHeight());
        $('#ob-sidebar-wrapper').fadeTo('fast',1);
        var bar = $('#ob-sidebar').niceScroll();
        bar.resize();
        $(window).resize(sidebarResize);
        
        /*
        * Filter accordion
        */

       $('.filters-top').click(function(e){
           var li = $(this).parents('li');
           li.toggleClass('collapsed').toggleClass('expanded');
           if(li.hasClass('collapsed')){
               li.find('.filters-bottom').slideUp(sidebarResize);
           } else {
               li.find('.filters-bottom').slideDown(sidebarResize);
           }
       });
    });
</script>
<div id="ob-sidebar-wrapper">
    <!--<div id="sidebar-button"></div>-->
        <div id="ob-sidebar">
        <!--<div class="sidebar-title">REFINE BY</div>-->
        <ul>
                <li id="shipping-time" class="filters expanded">
                    <div class="filters-top"><a>BRAND</a><div class="filter-button"></div></div>
                        <div class="filters-bottom">
                                <div class="filters-row first"><input type="checkbox" class="brand" id="1"/><div>ZEEDOG</div></div>
                                <div class="filters-row"><input type="checkbox" class="brand" id="2"/><div>PLAY</div></div>
                                <div class="filters-row last"><input type="checkbox" class="brand" id="3"/><div>FOUND MY ANIMAL</div></div>
                                <div class="filters-row last"><input type="checkbox" class="brand" id="4"/><div>IDOG</div></div>
                                <div class="filters-row last"><input type="checkbox" class="brand" id="5"/><div>UNLEASHED LIFE</div></div>
                        </div>
                </li>
                <li id="shipping-time" class="filters expanded">
                    <div class="filters-top"><a>COLOR</a><div class="filter-button"></div></div>
                        <div class="filters-bottom">
                                <div class="filters-row first"><input type="checkbox" class="color" id="color_1"/><div>BLACK</div></div>
                                <div class="filters-row"><input type="checkbox" class="color" id="color_2"/><div>BLUE</div></div>
                                <div class="filters-row last"><input type="checkbox" class="color" id="color_3"/><div>BROWN</div></div>
                                <div class="filters-row last"><input type="checkbox" class="color" id="color_4"/><div>GRAY</div></div>
                                <div class="filters-row last"><input type="checkbox" class="color" id="color_5"/><div>RED</div></div>
                        </div>
                </li>
                <li id="shipping-time" class="filters expanded">
                    <div class="filters-top"><a>SIZE</a><div class="filter-button"></div></div>
                        <div class="filters-bottom">
                                <div class="filters-row first"><input type="checkbox" class="size" id="s"/><div>SMALL</div></div>
                                <div class="filters-row"><input type="checkbox" class="size" id="m"/><div>MEDIUM</div></div>
                                <div class="filters-row last"><input type="checkbox" class="size" id="l"/><div>LARGE</div></div>
                        </div>
                </li>
        </ul>
        <!-- End of Filters --> 
    </div>
</div>
<!-- End of Sidebar -->
<div id="main-content">
    <?php
        if($viewHigh > 1)
        echo "<div class='pagination-groupList'></div>";
    ?>
    <!-- Products Grid -->
    <div id="products-grid">
        <input type="hidden" id="viewHigh" value="<?=$viewHigh?>"/>
        <input type="hidden" id="viewIndex" value="<?=$viewIndex?>"/>
        <table width="100%">
        <tr>
            <?php
                $count = 0;
                if(!empty($groupList)){
                    foreach($groupList as $row) {
                        if($count%3==0 && $count != 0){
                            echo "</tr><tr>"
                                    . "<td align='center'>"
                                        . "<div class='product'>"
                                            . "<img src='content/image/product/".$row['item_no'].".png'/>"
                                            . "<div class='product_detail'>"
                                                . "<a href='product?id=".$row['item_no']."'>+ SEE DETAIL</a>"
                                            . "</div>"
                                        . "</div>"
                                    . "</td>";
                        }
                        else {
                            echo "<td align='center'>"
                                    . "<div class='product'>"
                                        . "<img src='content/image/product/".$row['item_no'].".png'/>"
                                        . "<div class='product_detail'>"
                                            . "<a href='product?id=".$row['item_no']."'>+ SEE DETAIL</a>"
                                        . "</div>"
                                    . "</div>"
                                . "</td>";
                        }
                        $count += 1;
                    }
                }
            ?>
        </table>
    </div>
    <?php
        if($viewHigh > 1)
        echo "<div class='pagination-groupList'></div>";
    ?>
</div>
    
