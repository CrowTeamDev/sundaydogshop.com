<script src="js/views/shop.js" type="text/javascript"></script>
<?php
    if(!empty($_GET['fb']) && empty($_GET['cn'])){
        echo "<div id='category_view'>";
?>
    <table width="100%">
        <tr>
            <?php
                $count = 0;
                if(!empty($resultList)){
                    while($row = $resultList->fetch()) {
                        if($count%3==0 && $count != 0){
                            echo "</tr><tr align='center'>"
                                    . "<td><a href='shop?fb=c&cn=".$row['catagory_no']."'><img src='content/image/categories/".$row['catagory_no'].".png'/></a>"
                                        . "<a href='shop?fb=c&cn=".$row['catagory_no']."'><div class='category_name'>".$row['name']."</div></a>"
                                    . "</td>";
                        }
                        else {
                            echo "<td align='center'><a href='shop?fb=c&cn=".$row['catagory_no']."'><img src='content/image/categories/".$row['catagory_no'].".png'/></a>"
                                        . "<a href='shop?fb=c&cn=".$row['catagory_no']."'><div class='category_name'>".$row['name']."</div></a>"
                                    . "</td>";
                        }
                        $count += 1;
                    }
                }
            ?>
    </table>
<?
    echo "</div>";
    }
?>
<?php
    if(!empty($_GET['fb']) && !empty($_GET['cn'])){
        echo "<div id='product_view'>";
?>
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <?php
                $count = 0;
                if(!empty($resultList)){
                    while($row = $resultList->fetch()) {
                        if($count%3==0 && $count != 0){
                            echo "</tr><tr>"
                                    . "<td align='center'>"
                                        . "<div class='product'>"
                                            . "<img src='content/image/product/".$row['item_no'].".png'/>"
                                            . "<div class='product_detail'>"
                                                . "<a href='product?fb=c&cn=".$row['catagories']."&id=".$row['item_no']."'>+ SEE DETAIL</a>"
                                            . "</div>"
                                        . "</div>"
                                    . "</td>";
                        }
                        else {
                            echo "<td align='center'>"
                                    . "<div class='product'>"
                                        . "<img src='content/image/product/".$row['item_no'].".png'/>"
                                        . "<div class='product_detail'>"
                                            . "<a href='product?fb=c&cn=".$row['catagories']."&id=".$row['item_no']."'>+ SEE DETAIL</a>"
                                        . "</div>"
                                    . "</div>"
                                . "</td>";
                        }
                        $count += 1;
                    }
                }
            ?>
    </table>
<?
    echo "</div>";
    }
?>