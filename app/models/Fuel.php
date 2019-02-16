<?php 

require_once(realpath(dirname(__FILE__) . '/Product.php'));

class Fuel extends Product 
{
	public function __construct($id, $name, $price)
	{
		parent::__construct($id, $name, $price);
	}
}