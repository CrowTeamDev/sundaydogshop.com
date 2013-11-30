<?php
	include("controller/controller.php");
	include("module/services.php");
	include("view/view.php");
	
	$model = new Model();
	$controller = new Controller($model);
	$view = new View($controller, $model);
	 
	if (isset($_GET['action']) && !empty($_GET['action'])) {
	    $controller->{$_GET['action']}();
	}
	 
	echo $view->output();
?>