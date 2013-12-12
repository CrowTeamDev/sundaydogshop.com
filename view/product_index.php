
<html>
    <table>
            <?php
            while($row = $productList->fetch()) { 
                    echo "<ul><li>".$row['name']."</li>";
                    echo "<li>".$row['price'].  "</li></ul>";
                    echo "<img class='productImage' src= http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image1.png  id=".$row['item_no']."_1 data-zoom-image=http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image1.jpg >";
//                    echo "<ul  ><li><img src= content/image/product/".$row['item_no']."_1.png height='24' width='24' > </li>";
//                    echo "<li><img src= content/image/product/".$row['item_no']."_2.png  height='24' width='24' id=".$row['item_no']."_2  data-zoom-image='content/image/product/".$row['item_no']."_2.png' /> </li>";
//                    echo "<li><img src= content/image/product/".$row['item_no']."_3.png  height='24' width='24' id=".$row['item_no']."_3  data-zoom-image='content/image/product/".$row['item_no']."_3.png' /> </li></ul>";
                    echo "<div id=".$row['item_no'].">";   
                    echo "<a href='#' data-image='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image1.png' data-zoom-image='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image1.jpg'>";
                    echo "   <img id='img_01' src='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image1.png' height='50' width='50'/>";
                    echo "</a>";

                    echo "<a href='#' data-image='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image2.png' data-zoom-image='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image2.jpg'>";
                    echo "  <img id='img_01' src='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image2.png' height='50' width='50'/>";
                    echo "</a>";

                    echo "<a href='#' data-image='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image3.png' data-zoom-image='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image3.jpg'>";
                    echo "  <img id='img_01' src='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image3.png' height='50' width='50'/>";
                    echo "</a>";

                    echo "<a href='#' data-image='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image4.png' data-zoom-image='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/large/image4.jpg'>";
                    echo "  <img id='img_01' src='http://www.elevateweb.co.uk/wp-content/themes/radial/zoom/images/small/image4.png' height='50' width='50'/>";
                    echo "</a>";

                  echo "</div>";
            }
    ?>

    </table>
   
    <script>
       // $(".productImage").elevateZoom();
        
        $(".productImage").elevateZoom({gallery:'1', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true}); 

        //pass the images to Fancybox
        $(".productImage").bind("click", function(e) {  
          var ez =   $('.productImage').data('elevateZoom');	
                $.fancybox(ez.getGalleryList());
          return false;
        });
    </script>
</html>
