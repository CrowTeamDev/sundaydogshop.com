
<html>
    <table>
            <?php
            while($row = $productList->fetch()) { 
                    echo "<ol><li>".$row['name']."</li>";
                    echo "<li>".$row['price'].  "</li></ol>";
                    echo "<img class='productImage".$row['item_no']."' src= 'content/image/product/".$row['item_no']."_1.png'  id=".$row['item_no']."_1 data-zoom-image='content/image/product/".$row['item_no']."_1Large.png'  width='350px'  height='350px' >";
                    echo "<div id=".$row['item_no']." class='thumbnail'>";   
                    echo "<a href='#' data-image='content/image/product/".$row['item_no']."_1.png' data-zoom-image='content/image/product/".$row['item_no']."_1Large.png'>";
                    echo "   <img id='".$row['item_no']."_01' src='content/image/product/".$row['item_no']."_1.png'/>";
                    echo "</a>";
                    echo "<a href='#' data-image='content/image/product/".$row['item_no']."_2.png' data-zoom-image='content/image/product/".$row['item_no']."_2Large.png'>";
                    echo "   <img id='".$row['item_no']."_01' src='content/image/product/".$row['item_no']."_2.png'/>";
                    echo "</a>";
                     echo "<a href='#' data-image='content/image/product/".$row['item_no']."_3.png' data-zoom-image='content/image/product/".$row['item_no']."_3Large.png'>";
                    echo "   <img id='".$row['item_no']."_01' src='content/image/product/".$row['item_no']."_3.png'/>";
                    echo "</a>";

             
                  echo "</div>";
            }
    ?>

    </table>
   
    <script>
       // $(".productImage").elevateZoom();
        
        $(".productImage1").elevateZoom({gallery:'1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true}); 
        $(".productImage2").elevateZoom({gallery:'2', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true}); 



        //pass the images to Fancybox
        $(".productImage1").bind("click", function(e) {  
          var ez =   $('.productImage1').data('elevateZoom');	
                $.fancybox(ez.getGalleryList());
          return false;
        });
        
        
        
        
        function zoom(){
            
        }
    </script>
</html>
