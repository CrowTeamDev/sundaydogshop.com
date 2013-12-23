
<html>
    <table>
            <?php
            
            $id = $_GET["id"];

            while($row = $productList->fetch()) { 
                
                if (strcmp($id,$row['item_no'])==0){
                    echo "<div id='productDetail'>";
                        echo "<div>".$row['name']."</div>";
                        echo "<div>-----------------------</div>";
                        echo "<div>".$row['price']."</div>";
                        echo "<div>Product details</div>";
                        echo "<div>".$row['detail']."</div>";
                        echo "<div>Size <select>
                            <option value='S'>S</option>
                            <option value='M'>M</option>
                            <option value='L'>L</option>
                            <option value='XL'>XL</option>
                          </select></div>";
                         echo "<div>quantity <input type='text' maxlength=3 size=1><button type='button'>BUY</button></div>";
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
   
    <script>
       // $(".productImage").elevateZoom();
        
        $(".productImage").elevateZoom({gallery:'1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 
        //pass the images to Fancybox
        $(".productImage").bind("click", function(e) {  
          var ez =   $('.productImage1').data('elevateZoom');	
                $.fancybox(ez.getGalleryList());
          return false;
        });
        
        
        
        
        function zoom(){
            
        }
    </script>
    
    
</html>
