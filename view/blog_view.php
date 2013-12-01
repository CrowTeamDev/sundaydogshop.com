<h1><?php echo $blog_heading; ?></h1>

<p><?php echo $blog_content; ?></p>

<?php
	while($row = $product->fetch()) {
		echo $row['name'];
	}
?>
