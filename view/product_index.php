<script src="js/views/product.js" type="text/javascript"></script>
<table>
    <?php
        
        while($row = $productList->fetch()) { 
                echo "<div id='productDetail'>"
                ."<input type='hidden' value='".$row['name']."' id='name'/>"
                . "<div style='height: 25px; width: 100%;'>".$row['name']."</div>"
                . "<div style='background:#808080; height: 5px; width: 100%;'></div>"
                . "<div style='height: 50px;'>".$row['price']."</div>"
                . "<div>Product details</div>"
                . "<div>".$row['detail']."</div>"
                . "<div>SIZE<select>
                    <option value='S'>S</option>
                    <option value='M'>M</option>
                    <option value='L'>L</option>
                    <option value='XL'>XL</option>
                  </select></div>"
                . "<div>QUANTITY <input type='text' maxlength=3 size=1 id='quantity' onkeypress='return isNumber(event)'><button type='button' id='buy' onclick='buy()'>BUY</button></div>"
                . "<button type='button'>CHECK OUT</button></div>"
                . "</div>"
                . "<div id='productImage'>"
                . "<div class='img-resize'><img class='productImage' src= 'content/image/product/".$row['item_no']."_1.png'  id=".$row['item_no']."_1 data-zoom-image='content/image/product/".$row['item_no']."_1Large.png'></div>"
                . "<div id=".$row['item_no']." class='thumbnail'>"
                . "<a href='1' data-image='content/image/product/".$row['item_no']."_1.png' data-zoom-image='content/image/product/".$row['item_no']."_1Large.png'>"
                . "   <img id='".$row['item_no']."_01' src='content/image/product/".$row['item_no']."_1.png'/>"
                . "</a>"
                . "<a href='2' data-image='content/image/product/".$row['item_no']."_2.png' data-zoom-image='content/image/product/".$row['item_no']."_2Large.png'>"
                . "   <img id='".$row['item_no']."_01' src='content/image/product/".$row['item_no']."_2.png'/>"
                . "</a>"
                . "<a href='3' data-image='content/image/product/".$row['item_no']."_3.png' data-zoom-image='content/image/product/".$row['item_no']."_3Large.png'>"
                . "   <img id='".$row['item_no']."_01' src='content/image/product/".$row['item_no']."_3.png'/>"
                . "</a>"
                . "</div>"
                . "</div>";
        }
    ?>
</table>
<?php
    if(!empty($_GET['gb']))
        echo "<input type='hidden' id='gb' value='".$_GET['gb']."' />";
