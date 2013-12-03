<h1><?php echo "product_heading" ?></h1>
<html>
    <table>
        
            <?php
            while($row = $productList->fetch()) {
                    echo "<tr><td>".$row['name']."</td></tr>";
                    echo "<tr><td>".$row['price'].  "</td></tr>";
            }
    ?>

    </table>
</html>
