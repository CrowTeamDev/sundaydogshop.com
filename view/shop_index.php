<script src="js/views/shop.js" type="text/javascript"></script>
<script src="js/views/jquery.simplePagination.js"></script>
<script>
    $(function(){
        $('.pagination-groupList').pagination({
            items: 1,   // Total number of items that will be used to calculate the pages.
            itemsOnPage: 1, // Number of items displayed on each page.
            pages:$('#viewHigh').val(),   // If specified, items and itemsOnPage will not be used to calculate the number of pages.
            displayedPages:5, // How many page numbers should be visible while navigating. Minimum allowed: 3 (previous, current & next)
            edges:2,    // How many page numbers are visible at the beginning/ending of the pagination.
            currentPage: $('#viewIndex').val(), // Which page will be selected immediately after init.
            hrefTextPrefix: "shop?gb="+$('#gb').val()+"&viewIndex=", // A string used to build the href attribute, added before the page number.
            hrefTextSuffix: '', // Another string used to build the href attribute, added after the page number.
            prevText: "Prev", // Text to be display on the previous button.
            nextText: "Next", // Text to be display on the next button.
            cssStyle: "light-theme", // The class of the CSS theme.
            selectOnClick: true, // Set to false if you don't want to select the page immediately after click.
        });
        $('.pagination-productList').pagination({
            items: 1,   // Total number of items that will be used to calculate the pages.
            itemsOnPage: 1, // Number of items displayed on each page.
            pages:$('#viewHigh').val(),   // If specified, items and itemsOnPage will not be used to calculate the number of pages.
            displayedPages:5, // How many page numbers should be visible while navigating. Minimum allowed: 3 (previous, current & next)
            edges:2,    // How many page numbers are visible at the beginning/ending of the pagination.
            currentPage: $('#viewIndex').val(), // Which page will be selected immediately after init.
            hrefTextPrefix: "shop?gb="+$('#gb').val()+"&f="+$('#f').val()+"&viewIndex=", // A string used to build the href attribute, added before the page number.
            hrefTextSuffix: '', // Another string used to build the href attribute, added after the page number.
            prevText: "Prev", // Text to be display on the previous button.
            nextText: "Next", // Text to be display on the next button.
            cssStyle: "light-theme", // The class of the CSS theme.
            selectOnClick: true, // Set to false if you don't want to select the page immediately after click.
        });
    });
</script>
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
