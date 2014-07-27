<script src="js/views/shopIndex.js" type="text/javascript"></script>
<script src="js/views/jquery.simplePagination.js"></script>
<script src="js/views/jquery.nicescroll.js"></script>
<link rel="stylesheet" type="text/css" href="css/shop.css" />
<input type="hidden" id="gb" value="<?php echo $groupBy ?>"/>
<script>
    $(function(){
        // Sidebar
        var sidebarResize = function(){
            $('#ob-sidebar-wrapper, #ob-sidebar').height($(window).height()-200-$("footer").outerHeight());
            $('#ob-sidebar').niceScroll().resize();
            
        };
        $('#ob-sidebar-wrapper, #ob-sidebar').height($(window).height()-200-$("footer").outerHeight());
        $('#ob-sidebar-wrapper').fadeTo('fast',1);
        var bar = $('#ob-sidebar').niceScroll();
        bar.resize();
        $(window).resize(sidebarResize);
        $("#ascrail2000").remove();
        
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
       
       $('.filters-row.category').mouseover(function(){
            var selected = $('.filters-row.category.active');
            if (selected.attr('id') === undefined) selected = $('.filters-row.category.active');
            $(this).addClass('active');
            
            selected.removeClass('active');
            selected.addClass('actived');
        });
        $('.filters-row.category').mouseout(function(){
            var selected = $('.filters-row.category.actived');
            if (selected.attr('id') === undefined) selected = $('.filters-row.category.actived');
            $(this).removeClass('active');
            
            selected.removeClass('actived');
            selected.addClass('active');
       });
       
       
       $('.filters-row.category').click(function(){
           window.location.href = 'shop?gb=' + this.id;
       });
       
       $('.filters-row.filter').click(function(){
            var brand = "";
            var color = "";
            var size = "";
            if($(this).hasClass('active')){
                $(this).removeClass('active');
            } else {
                $(this).addClass('active');
            }
            $('div.filters-row.filter.active').each(function(){
                var idValue = this.id;
                var idArray = idValue.split('_');
                if(idArray[0]=='brand'){
                    var sBrand = (idArray[1] ? idArray[1] : "");
                    brand += (brand=="" ? sBrand : "," + sBrand);
                }
                if(idArray[0]=='color'){
                    var sColor = (idArray[1] ? idArray[1] : "");
                    color += (color=="" ? sColor : "," + sColor);
                }
                if(idArray[0]=='size'){
                    var sSize = (idArray[1] ? idArray[1] : "");
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
    });
</script>
<div id="ob-sidebar-wrapper">
    <!--<div id="sidebar-button"></div>-->
    <div id="ob-sidebar">
        <!--<div class="sidebar-title">REFINE BY</div>-->
        <ul>
            <li class="filters expanded">
                <div class="filters-top"><a>CATEGORY</a></div>
                    <div class="filters-bottom">
                            <div class="filters-row category <?php if($groupBy=='a') echo "active";?>" id="a"><div>ALL</div></div>
                            <div class="filters-row category <?php if($groupBy=='e') echo "active";?>" id="e"><div>EAT</div></div>
                            <div class="filters-row category <?php if($groupBy=='wa') echo "active";?>" id="wa"><div>WALK</div></div>
                            <div class="filters-row category <?php if($groupBy=='p') echo "active";?>" id="p"><div>PLAY</div></div>
                            <div class="filters-row category <?php if($groupBy=='we') echo "active";?>" id="we"><div>WEAR</div></div>
                            <div class="filters-row category <?php if($groupBy=='s') echo "active";?>" id="s"><div>SLEEP</div></div>
                            <div class="filters-row category <?php if($groupBy=='sa') echo "active";?>" id="sa"><div>SALE</div></div>
                    </div>
            </li>
            <?php
                $checkExisted1 = false;
                
                $html1 = "";
                $html1 .= "<li class='filters expanded'>";
                $html1 .= "<div class='filters-top'><a>BRAND</a></div>";
                $html1 .= "<div class='filters-bottom'>";
                        
                foreach ($filterList as $key => $vals){
                    if($key=='brand'){
                        foreach ($vals as $key => $val){
                            $checkExisted1 = true;
                            $html1 .= "<div class=\"filters-row filter\" id=\"brand_".$val['brand_no']."\"><div>".strtoupper($val['brand'])."</div></div>";
                        }
                    }
                }
                $html1 .= "</div>";
                $html1 .= "</li>";
                
                if ($checkExisted1){
                    echo $html1;
                }
            ?>
            <?php
                $checkExisted2 = false;
                
                $html2 = "";
                $html2 .= "<li class='filters expanded'>";
                $html2 .= "<div class='filters-top'><a>COLOR</a></div>";
                $html2 .= "<div class='filters-bottom'>";
                
                foreach ($filterList as $key => $vals){
                    if($key=='color'){
                        foreach ($vals as $key => $val){
                            if ($val['color'] != null){
                                $checkExisted2 = true;
                                $html2 .= "<div class=\"filters-row filter\" id=\"color_".$val['color']."\"><div>".strtoupper($val['color'])."</div></div>";
                            }
                        }
                    }
                }
                $html2 .= "</div>";
                $html2 .= "</li>";
                
                if ($checkExisted2){
                    echo $html2;
                }
            ?>
            <?php
                $checkExisted3 = false;
            
                $html3 = "";
                $html3 .= "<li class='filters expanded'>";
                $html3 .= "<div class='filters-top'><a>SIZE</a></div>";
                $html3 .= "<div class='filters-bottom' id='filter_size'>";

                foreach ($filterList as $key => $vals){
                    if($key=='size'){
                        foreach ($vals as $key => $val){
                            $checkExisted3 = true;
                            $html3 .= "<div class=\"filters-row filter\" id=\"size_".$val['size']."\">".strtoupper($val['size'])."</div>";
                        }
                    }
                }
                $html3 .= "</div>";
                $html3 .= "</li>";
                
                if ($checkExisted3){
                    echo $html3;
                }
            ?>
        </ul>
        <!-- End of Filters -->
        <svg id="arrow_down" viewBox="0 0 100 30">
            <polyline points="0,0 50,30 100,0" style="fill:none;stroke:white;stroke-width:3;" />
        </svg>
    </div>
</div>
<!-- End of Sidebar -->
<div id="main-content">
    <?php
//        if($viewHigh > 1)
//        echo "<div class='pagination-groupList'></div>";
    ?>
    <!-- Products Grid -->
    <div id="products-grid">
        <table width="100%">
        <tr>
            <?php
                $count = 0;
                if(!empty($groupList)){
                    foreach($groupList as $row) {
                        if($count%3==0 && $count != 0){
                            echo "</tr><tr>"
                                    . "<td align='right'>"
                                        . "<div class='product'>"
                                            . "<a href='product?id=".$row['item_no']."&gb=".$groupBy."'>"
                                                . "<img src='content/image/product/".$row['item_no'].".jpg'/>"
                                                . "<div class='product_detail'>"
                                                    . "+ SEE DETAIL"
                                                . "</div>"
                                            . "</a>"
                                        . "</div>"
                                    . "</td>";
                        }
                        else {
                            echo "<td align='right'>"
                                        . "<div class='product'>"
                                            . "<a href='product?id=".$row['item_no']."&gb=".$groupBy."'>"
                                                . "<img src='content/image/product/".$row['item_no'].".jpg'/>"
                                                . "<div class='product_detail'>"
                                                    . "+ SEE DETAIL"
                                                . "</div>"
                                            . "</a>"
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
//        if($viewHigh > 1)
//        echo "<div class='pagination-groupList'></div>";
    ?>
</div>
    
