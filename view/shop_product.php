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
</script>
<?php
    if($viewHigh > 1 && !$paginate)
    echo "<div class='pagination-groupList'></div>";
    if(!$paginate)
    echo "<div id='products-grid'>";
?>
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
<?php
    if(!$paginate)
    echo "</div>";
    if($viewHigh > 1 && !$paginate)
    echo "<div class='pagination-groupList'></div>";
?>