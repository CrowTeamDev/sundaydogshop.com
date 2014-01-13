
<html>
    <head>
        <meta charset="utf-8">
        <title>
            
        </title>
          <style>
/*            .toggler { width: 500px; height: 200px; position: relative; }
            #button { padding: .5em 1em; text-decoration: none; }
            #effect { width: 240px; height: 135px; padding: 0.4em; position: relative; }
            #effect h3 { margin: 0; padding: 0.4em; text-align: center; }
            .ui-effects-transfer { border: 2px dotted gray; }*/
            .no-close .ui-dialog-titlebar-close {display: none;}
          </style>
    </head>
    <body>
    <table>
            <?php
            
            $id = $_GET["id"];

            while($row = $productList->fetch()) { 
                
                if (strcmp($id,$row['item_no'])==0){
                    echo "<div id='productDetail'>";
                        echo "<input type='hidden' value='".$row['name']."' id='name'/>";
                        echo "<div style=' height: 25px; width: 100%;'>".$row['name']."</div>";
                        echo "<div style='background:#808080; height: 5px; width: 100%;'></div>";
                        echo "<div style=' height: 50px;'>".$row['price']."</div>";
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
                    
//                     echo "<div id='dialog'>";
//                    echo " <p>You just added " .$row['name']. " to your cart</p>";
//                    echo " </div>";
                }
            }
    ?>

        </table>
       
    </body>
   
    <script>
       // $(".productImage").elevateZoom();
        
        $(".productImage").elevateZoom({gallery:'productImage', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 
        //pass the images to Fancybox
        $(".productImage").bind("click", function(e) {  
          var ez =   $('.productImage').data('elevateZoom');	
                $.fancybox(ez.getGalleryList());
          return false;
        });
         
    
    $(document).ready(function() {
//          $("#dialog").css('visibility','hidden');
           $("#dialog").hide();
    });

        
        function buy(){
            var newDiv = $(document.createElement('div')); 
            if($("#quantity").val()!==''){
                var quantity = trimNumber($("#quantity").val());
                newDiv.html('<p align="center">you just added<br> '+quantity +' "'+ $("#name").val()  +'"<br> to your cart </p>');


                    newDiv.dialog({
                        hide:  ('fade',3000),
                        show: ('fade',3000),
                        modal: true,
                        dialogClass: "no-close success-dialog",
                        open: function(event, ui){
                        setTimeout(newDiv.dialog('close'),5000);
                       }
                   });
                   $(".ui-dialog-titlebar").hide();
               }


       }

 
 
        function isNumber(evt) {
           evt = (evt) ? evt : window.event;
           var charCode = (evt.which) ? evt.which : evt.keyCode;
           if (charCode > 31 && (charCode < 48 || charCode > 57)) {
               return false;
           }
           return true;
       }
       
       function trimNumber(s) {
            while (s.substr(0,1) == '0' && s.length>1) { s = s.substr(1,9999); }
            return s;
       }
    </script>
    
    
</html>
