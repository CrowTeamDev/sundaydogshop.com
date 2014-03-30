<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<script src="js/views/shopIndex.js" type="text/javascript"></script>
<script src="js/views/jquery.simplePagination.js"></script>
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
    });
</script>
<div id='products-grid'>
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
                                            . "<img src='content/image/product/".$row['item_no'].".png'/>"
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
                                        . "<img src='content/image/product/".$row['item_no'].".png'/>"
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