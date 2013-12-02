<h1><?php echo $shop_heading; ?></h1>

<?php
	while($row = $productList->fetch()) {
		echo $row['name'];
	}
?>