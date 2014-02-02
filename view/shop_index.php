<script src="js/views/shop.js" type="text/javascript"></script>
<script src="js/views/jquery.simplePagination.js"></script>
<input type="hidden" id="viewHigh" value="<?=$viewHigh?>"/>
<input type="hidden" id="viewIndex" value="<?=$viewIndex?>"/>
<?php
    if(!empty($groupList)){
        if($viewHigh > 1)
            echo "<div class='pagination-groupList'></div>";
        
        echo "<div id='find_by_view'>";
?>
    <table width="100%">
        <tr>
            <?php
                $count = 0;
                if(!empty($groupList)){
                    foreach($groupList as $row) {
                        if($count%3==0 && $count != 0){
                            if($_GET['gb']=='c' || $_GET['gb']=='b'){
                                echo "</tr><tr align='center'>"
                                    . "<td><a href='shop?gb=c&f=".$row['catagory_no']."'><img src='content/image/categories/".$row['catagory_no'].".png'/></a>"
                                    . "<a href='shop?gb=c&f=".$row['catagory_no']."'><div class='category_name'>".$row['name']."</div></a>"
                                    . "</td>";   
                            }
                            else if($_GET['gb']=='s'){
                                echo "</tr><tr align='center'>"
                                    . "<td><a href='shop?gb=s&f=".$row['size']."'><img src='content/image/categories/".$row['size'].".png'/></a>"
                                    . "<a href='shop?gb=s&f=".$row['size']."'><div class='category_name'>".$row['size']."</div></a>"
                                    . "</td>"; 
                            }
                        }
                        else {
                            if($_GET['gb']=='c' || $_GET['gb']=='b'){
                                echo "<td align='center'><a href='shop?gb=c&f=".$row['catagory_no']."'><img src='content/image/categories/".$row['catagory_no'].".png'/></a>"
                                    . "<a href='shop?gb=c&f=".$row['catagory_no']."'><div class='category_name'>".$row['name']."</div></a>"
                                    . "</td>";   
                            }
                            else if($_GET['gb']=='s'){
                                echo "<td align='center'><a href='shop?gb=s&f=".$row['size']."'><img src='content/image/categories/".$row['size'].".png'/></a>"
                                    . "<a href='shop?gb=s&f=".$row['size']."'><div class='category_name'>".$row['size']."</div></a>"
                                    . "</td>"; 
                            }
                        }
                        $count += 1;
                    }
                }
            ?>
    </table>
<?php
    echo "</div>";
    if($viewHigh > 1)
            echo "<div class='pagination-groupList'></div>";
    }
?>
<?php
    if(!empty($productList)){
        if($viewHigh > 1)
            echo "<div class='pagination-productList'></div>";
        
        echo "<div id='product_view'>";
?>
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <?php
                $count = 0;
                foreach($productList as $row) {
                    if($count%3==0 && $count != 0){
                        echo "</tr><tr>"
                                . "<td align='center'>"
                                    . "<div class='product'>"
                                        . "<img src='content/image/product/".$row['item_no'].".png'/>"
                                        . "<div class='product_detail'>"
                                            . "<a href='product?gb=".$_REQUEST['gb']."&f=".$GLOBALS['findBy']."&id=".$row['item_no']."'>+ SEE DETAIL</a>"
                                        . "</div>"
                                    . "</div>"
                                . "</td>";
                    }
                    else {
                        echo "<td align='center'>"
                                . "<div class='product'>"
                                    . "<img src='content/image/product/".$row['item_no'].".png'/>"
                                    . "<div class='product_detail'>"
                                        . "<a href='product?gb=".$_REQUEST['gb']."&f=".$GLOBALS['findBy']."&id=".$row['item_no']."'>+ SEE DETAIL</a>"
                                    . "</div>"
                                . "</div>"
                            . "</td>";
                    }
                    $count += 1;
                }
            ?>
    </table>
<?php
    echo "</div>";
        if($viewHigh > 1)
            echo "<div class='pagination-productList'></div>";
    }
    if(!empty($_GET['gb']))
        echo "<input type='hidden' id='gb' value='".$_GET['gb']."' />";
    if(!empty($GLOBALS['findBy']))
        echo "<input type='hidden' id='f' value='".$GLOBALS['findBy']."' />";
?>
