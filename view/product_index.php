<?php
    $row = $productList->fetch();
    $name = $row['name'];
    $price = $row['price'];
    $weight = $row['weight'];
    $detail = $row['detail'];
    $itemNo = $row['item_no'];
    
    $id_1 = $row['item_no']."_1";
    $img_1 = "content/image/product/".$itemNo."_1.png";
    $zoom_1 = "content/image/product/".$itemNo."_1Large.png";
    $id_2 = $row['item_no']."_2";
    $img_2 = "content/image/product/".$itemNo."_2.png";
    $zoom_2 = "content/image/product/".$itemNo."_2Large.png";
    $id_3 = $row['item_no']."_3";
    $img_3 = "content/image/product/".$itemNo."_3.png";
    $zoom_3 = "content/image/product/".$itemNo."_3Large.png";
?>
<script src="js/views/product.js" type="text/javascript"></script>
<div id="product_main">
    <div id="productImage">
        <div class="img-resize">
            <img class="productImage"
                 src="<?php echo $img_1; ?>"
                 id="<?php echo $id_1; ?>"
                 data-zoom-image="<?php echo $zoom_1; ?>" >
        </div>
        <div id="<?php echo $itemNo; ?>" class="thumbnail">
            <a href="1"
               data-image="<?php echo $img_1; ?>"
               data-zoom-image="<?php echo $zoom_1; ?>" >
                <img id="<?php echo $id_1; ?>"
                     src="<?php echo $img_1; ?>" />
            </a>
            <a href="2"
               data-image="<?php echo $img_2; ?>"
               data-zoom-image="<?php echo $zoom_2; ?>" >
                <img id="<?php echo $id_2; ?>"
                     src="<?php echo $img_2; ?>" />
            </a>
            <a href="3"
               data-image="<?php echo $img_3; ?>"
               data-zoom-image="<?php echo $zoom_3; ?>" >
                <img id="<?php echo $id_3; ?>"
                     src="<?php echo $img_3; ?>" />
            </a>
        </div>
    </div>
    <div id="zoomBox"></div>
    <div id="productDetail">
        <input type="hidden" id="product_id" value="<?php echo $itemNo; ?>" />
        <input type="hidden" id="product_weight" value="<?php echo $weight; ?>" />
        <div id="product_name"><?php echo $name; ?></div>
        <hr style="height: 3px; background: #ACAEB0; border: none;" />
        <div id="product_price"><span><?php echo $price; ?></span> BAHT</div>
        <div id="product_detail">
            Product details
            <span><?php echo $detail; ?></span>
        </div>
        <hr style="height: 3px; background: #ACAEB0; border: none;" />
        <div style="margin: 20px 0;">
            SIZE
            <select id="product_size" style="float: right; margin-right: 25px;">
                <option value=""> -- Please Select -- </option>
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
            </select>
        </div>
        <?php
            // Check color list
            /*foreach ($filterList as $key => $vals){
            <div style="margin: 20px 0;">
                COLOR
                <select id="product_color" style="float: right; margin-right: 25px;">
                    <option value=""> -- Please Select -- </option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                </select>
            </div>*/
        ?>
        <div style="margin: 30px 0; vertical-align: middle;">
            QUANTITY
            <input type="number" min="1" max="99" value="1"
                   id="quantity" style="width: 35px; margin: 0 15px;" />
            <label id="product_buy">BUY</label>
        </div>
        <label id="product_checkOut">CHECK OUT</label>
    </div>
</div>
<?php
    if(!empty($_GET['gb']))
        echo "<input type='hidden' id='gb' value='".$_GET['gb']."' />";
