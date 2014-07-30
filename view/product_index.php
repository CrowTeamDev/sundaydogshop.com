<?php
    $row = $productList->fetch();
    $name = $row['name'];
    $price = $row['price'];
    $weight = $row['weight'];
    $detail = $row['detail'];
    $material = $row['material'];
    $care = $row['care_instruction'];
    $itemNo = $row['item_no'];
    
    $id_1 = $row['item_no']."_1";
    $img_1 = "content/image/product/".$itemNo."_1.jpg";
    $zoom_1 = "content/image/product/".$itemNo."_1Large.jpg";
    $id_2 = $row['item_no']."_2";
    $img_2 = "content/image/product/".$itemNo."_2.jpg";
    $zoom_2 = "content/image/product/".$itemNo."_2Large.jpg";
    $id_3 = $row['item_no']."_3";
    $img_3 = "content/image/product/".$itemNo."_3.jpg";
    $zoom_3 = "content/image/product/".$itemNo."_3Large.jpg";
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
            <?php
                $html1 = '<a href="1" data-image="'.$img_1.'" data-zoom-image="'.$zoom_1.'" >';
                $html1 .= '<img id="'.$id_1.'" src="'.$img_1.'" />';
                $html1 .= '</a>';
                
                if (file_exists($img_1)){
                    echo $html1;
                }
                
                $html2 = '<a href="2" data-image="'.$img_2.'" data-zoom-image="'.$zoom_2.'" >';
                $html2 .= '<img id="'.$id_2.'" src="'.$img_2.'" />';
                $html2 .= '</a>';
                
                if (file_exists($img_2)){
                    echo $html2;
                }
            
                $html3 = '<a href="3" data-image="'.$img_3.'" data-zoom-image="'.$zoom_3.'" >';
                $html3 .= '<img id="'.$id_3.'" src="'.$img_3.'" />';
                $html3 .= '</a>';
                
                if (file_exists($img_3)){
                    echo $html3;
                }
            ?>
        </div>
    </div>
    <div id="zoomBox"></div>
    <div id="productDetail">
        <input type="hidden" id="product_id" value="<?php echo $itemNo; ?>" />
        <input type="hidden" id="product_weight" value="<?php echo $weight; ?>" />
        <div id="product_name"><?php echo strtoupper($name); ?></div>
        <hr style="height: 3px; background: #ACAEB0; border: none;" />
        <div id="product_price"><span><?php echo $price; ?></span> BAHT</div>
        <div id="product_detail">
            PRODUCT DETAILS
            <span><?php echo $detail; ?></span>
            DIMENSION
            <span id="dimention_detail">
                <?php
                    foreach ($dimensionList as $key){
                        if ($key['size'] !== '-'){
                            echo "<div id='".strtoupper($key['size'])."'>Size ".strtoupper($key['size']).": <br>";
                        }
                        echo $key['dimension'];
                        if ($key !== end($dimensionList)){
                            echo "<br></div>";
                        }
                    }
                ?>
            </span>
            MATERIAL
            <span><?php echo $material; ?></span>
            CARE INSTRUCTION
            <span><?php echo $care; ?></span>
        </div>
        <hr style="height: 3px; background: #ACAEB0; border: none;" />
        <div style="margin: 20px 0;">
            SIZE
            <select id="product_size" style="float: right; margin-right: 25px;">
                <?php
                    foreach ($sizeList as $key){
                        echo "<option value='".$key['price']."' weight='".$key['weight']."' selected>".$key['size']."</option>";
                    }
                ?>
            </select>
        </div>
        <?php
            $colorExisted = false;
        
            $html = "";
            $html .= "<div style='margin: 20px 0;'>";
            $html .= "COLOR";
            $html .= "<select id='product_color' style='float: right; margin-right: 25px;'>";
            $html .= "<option value=''> -- Please Select -- </option>";
            foreach ($colorList as $key){
                $colorExisted = true;
                $html .= "<option value='".$key['color']."'>".$key['color']."</option>";
            }
            $html .= "</select>";
            $html .= "</div>";

            if ($colorExisted){
                echo $html;
            }
        ?>
        <div style="margin: 30px 0; vertical-align: middle;">
            QUANTITY
            <input type="number" min="1" max="99" value="1"
                   id="quantity" style="width: 35px; margin: 0 15px;" />
            <label id="product_buy"></label>
        </div>
        <label id="product_checkOut"></label>
    </div>
</div>
<?php
    if(!empty($_GET['gb']))
        echo "<input type='hidden' id='gb' value='".$_GET['gb']."' />";
