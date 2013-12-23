<script src="js/views/shop.js" type="text/javascript"></script>
<h1><?php echo $shop_heading; ?></h1>

<?php
	while($row = $productList->fetch()) {
		echo $row['name'];
	}
?>