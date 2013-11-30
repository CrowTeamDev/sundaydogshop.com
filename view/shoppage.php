<?php
include("../controller/controller.php");
include("../module/services.php");

class View
{
    private $model;
    private $controller;
 
    public function __construct($controller,$model) {
        $this->controller = $controller;
        $this->model = $model;
    }
 
    public function output() {
        return '<p><a href="shoppage.php?action=clicked">' . $this->model->string . "</a></p>";
    }
}
	
$model = new Model();
$controller = new Controller($model);
$view = new View($controller, $model);
 
if (isset($_GET['action']) && !empty($_GET['action'])) {
    $controller->{$_GET['action']}();
}
 
echo $view->output();
?>