<script src="js/views/product.js" type="text/javascript"></script>
<table>
    <?php
        $id = $_GET["id"];
        while($row = $productList->fetch()) { 
            if (strcmp($id,$row['item_no'])==0){
                echo "<div id='productDetail'>";
                echo "<input type='hidden' value='".$row['name']."' id='name'/>";
                echo "<div style='height: 25px; width: 100%;'>".$row['name']."</div>";
                echo "<div style='background:#808080; height: 5px; width: 100%;'></div>";
                echo "<div style='height: 50px;'>".$row['price']."</div>";
                echo "<div>Product details</div>";
                echo "<div>".$row['detail']."</div>";
                echo "<div>SIZE<select>
                    <option value='S'>S</option>
                    <option value='M'>M</option>
                    <option value='L'>L</option>
                    <option value='XL'>XL</option>
                  </select></div>";
                echo "<div>QUANTITY <input type='text' maxlength=3 size=1 id='quantity' onkeypress='return isNumber(event)'><button type='button' id='buy' onclick='buy()'>BUY</button></div>";
                echo "<button type='button'>CHECK OUT</button></div>";
                echo "</div>";
                echo "<div id='productImage'>";
                echo "<div class='img-resize'><img class='productImage' src= 'content/image/product/".$row['item_no']."_1.png'  id=".$row['item_no']."_1 data-zoom-image='content/image/product/".$row['item_no']."_1Large.png'></div>";
                echo "<div id=".$row['item_no']." class='thumbnail'>";   
                echo "<a href='1' data-image='content/image/product/".$row['item_no']."_1.png' data-zoom-image='content/image/product/".$row['item_no']."_1Large.png'>";
                echo "   <img id='".$row['item_no']."_01' src='content/image/product/".$row['item_no']."_1.png'/>";
                echo "</a>"; 
                echo "<a href='2' data-image='content/image/product/".$row['item_no']."_2.png' data-zoom-image='content/image/product/".$row['item_no']."_2Large.png'>";
                echo "   <img id='".$row['item_no']."_01' src='content/image/product/".$row['item_no']."_2.png'/>";
                echo "</a>"; 
                echo "<a href='3' data-image='content/image/product/".$row['item_no']."_3.png' data-zoom-image='content/image/product/".$row['item_no']."_3Large.png'>";
                echo "   <img id='".$row['item_no']."_01' src='content/image/product/".$row['item_no']."_3.png'/>";
                echo "</a>";
                echo "</div>";
                echo "</div>";
            }
        }
    ?>
</table>
<?php
    if(!empty($_GET['fb']))
        echo "<input type='hidden' id='fb' value='".$_GET['fb']."' />";