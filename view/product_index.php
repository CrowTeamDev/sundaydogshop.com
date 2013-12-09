<html>
    <table>
            <?php
            while($row = $productList->fetch()) { 
                    echo "<ul><li>".$row['name']."</li>";
                    echo "<li>".$row['price'].  "</li></ul>";
                    echo "<ul><li><img src= content/image/product/".$row['item_no']."_1.png height='24' width='24'  /> </li>";
                    echo "<li><img src= content/image/product/".$row['item_no']."_2.png  height='24' width='24'/> </li>";
                    echo "<li><img src= content/image/product/".$row['item_no']."_3.png  height='24' width='24'/> </li></ul>";
                    
            }
    ?>

    </table>
</html>
