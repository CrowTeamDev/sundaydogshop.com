<script src="js/views/shop.js" type="text/javascript"></script>
<script src="js/views/jquery.simplePagination.js"></script>
<script src="js/views/jquery.nicescroll.js"></script>
<link rel="stylesheet" type="text/css" href="css/shop.css" />
<input type="hidden" id="viewHigh" value="<?=$viewHigh?>"/>
<input type="hidden" id="viewIndex" value="<?=$viewIndex?>"/>

<div id="ob-sidebar-wrapper">
    <!--<div id="sidebar-button"></div>-->
            <div id="ob-sidebar">
            <!--<div class="sidebar-title">REFINE BY</div>-->
            <ul>
                    <li id="shipping-time" class="filters expanded">
                        <div class="filters-top"><a>BRAND</a><div class="filter-button"></div></div>
                            <div class="filters-bottom">
                                    <div class="filters-row first"><input type="checkbox" /><div>ZEEDOG</div></div>
                                    <div class="filters-row"><input type="checkbox" /><div>PLAY</div></div>
                                    <div class="filters-row last"><input type="checkbox" /><div>FOUND MY ANIMAL</div></div>
                                    <div class="filters-row last"><input type="checkbox" /><div>IDOG</div></div>
                                    <div class="filters-row last"><input type="checkbox" /><div>UNLEASHED LIFE</div></div>
                            </div>
                    </li>
                    <li id="shipping-time" class="filters expanded">
                        <div class="filters-top"><a>COLOR</a><div class="filter-button"></div></div>
                            <div class="filters-bottom">
                                    <div class="filters-row first"><input type="checkbox" /><div>BLACK</div></div>
                                    <div class="filters-row"><input type="checkbox" /><div>BLUE</div></div>
                                    <div class="filters-row last"><input type="checkbox" /><div>BROWN</div></div>
                                    <div class="filters-row last"><input type="checkbox" /><div>GRAY</div></div>
                                    <div class="filters-row last"><input type="checkbox" /><div>RED</div></div>
                            </div>
                    </li>
                    <li id="shipping-time" class="filters expanded">
                        <div class="filters-top"><a>SIZE</a><div class="filter-button"></div></div>
                            <div class="filters-bottom">
                                    <div class="filters-row first"><input type="checkbox" /><div>SMALL</div></div>
                                    <div class="filters-row"><input type="checkbox" /><div>MEDIUM</div></div>
                                    <div class="filters-row last"><input type="checkbox" /><div>LARGE</div></div>
                            </div>
                    </li>
            </ul>
            <!-- End of Filters --> 
    </div>
</div>
<!-- End of Sidebar -->
<div id="main-content">
    
    <!-- Products Grid -->
    <div id="products-grid">
        <?php
            if($viewHigh > 1)
            echo "<div class='pagination-groupList'></div>";
        ?>
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
            if($viewHigh > 1)
            echo "<div class='pagination-groupList'></div>";
        ?>
    </div>
</div>
    
