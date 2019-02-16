<?php

require_once(realpath(dirname(__FILE__) . '/Product.php'));

class Car extends Product 
{
	private $fuels;

	public function __construct($id, $name, $price, $fuels)
	{
		$this->fuels = $fuels;
		parent::__construct($id, $name, $price);
	}

	public function getFuels() {
        return $this->fuels;
    }
    public function setFuels($fuels) {
        $this->fuels = $fuels;
    }
    
    public function addFuel(Fuel $fuel) {
        array_push($this->fuels, $fuel);
    }
    
    public function removeFuel(Fuel $fuel) {
        unset($this->fuels[$fuel]);
    }

}