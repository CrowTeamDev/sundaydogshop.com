<?php
    $row = $productList->fetch();
    $name = $row['name'];
    $price = $row['price'];
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
<table>
    <div id="productDetail">
        <input type="hidden" value="<?php echo $name; ?>" id="name" />
        <div style="height: 25px; width: 100%;"><?php echo $name; ?></div>
        <div style="background:#808080; height: 5px; width: 100%;"></div>
        <div style="height: 50px;"><?php echo $price; ?></div>
        <div>Product details</div>
        <div><?php echo $detail; ?></div>
        <div>SIZE<select>
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
        </select></div>
        <div>
            QUANTITY
            <input type="text" maxlength=3 size=1 id="quantity" onkeypress="return isNumber(event)">
            <button type="button" id="buy" onclick="buy()">BUY</button>
        </div>
        <button type="button">CHECK OUT</button>
    </div>
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
</table>
<?php
    if(!empty($_GET['fb']))
        echo "<input type='hidden' id='fb' value='".$_GET['fb']."' />";