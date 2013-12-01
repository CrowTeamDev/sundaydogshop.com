<?php
class product{
	protected $registry;

	function __construct($registry) {
		$this->registry = $registry;
	}
	
	public function getUserName() {
		$test->name = db::getInstance()->query('SELECT name FROM User');
		return  $test->name;
	}
}
?>