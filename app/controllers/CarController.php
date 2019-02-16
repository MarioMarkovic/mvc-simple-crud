<?php 
require_once(realpath(dirname(__FILE__) . '/../core/Model.php'));
require_once(realpath(dirname(__FILE__) . '/../models/Car.php'));
require_once(realpath(dirname(__FILE__) . '/../models/Fuel.php'));

class CarController 
{
	private $model;

	public function __construct()
	{
		$this->model = new Model;
	}

	public function index()
	{
		$data = [];
		$view = '../views/car/index.php';
		$cars = $this->model->select("SELECT id, name, price FROM car");
		foreach($cars as $car){
            array_push($data, new Car($car['id'], $car['name'], $car['price'], NULL));
        }

        return ['data' => $data, 'view' => $view];
	}

	public function show($id)
	{
		if(is_numeric($id) && !empty($id)) {
			$view = '../views/car/show.php';
			$params = ['id' => $id];
			$fuels = [];

			$getFuels = $this->model->select("SELECT id, name, price FROM fuel INNER JOIN car_fuel ON fuel.id=car_fuel.fuel_id WHERE car_id=:id", $params);
			foreach($getFuels as $fuel) {
				array_push($fuels, new Fuel($fuel['id'], $fuel['name'], $fuel['price']));
			}

			$car = $this->model->select("SELECT id, name, price FROM car WHERE id=:id", $params);
			$data = new Car($car[0]['id'], $car[0]['name'], $car[0]['price'], $fuels);
            
        	return ['data' => $data, 'view' => $view];
		}
	}

	public function create()
	{
		$view = '../views/car/create.php';
	    return ['view' => $view];
	}

	public function insert($name, $price)
	{
		if(!empty(trim($name)) && !empty(trim($price))) {
			$sql = "INSERT INTO car (name, price) VALUES (:name, :price)";
			$params = [ ':name' => $name, ':price' => $price ];
			$view = '../views/car/show.php';

			$carId = $this->model->insert($sql, $params);
			$car = new Car($carId, $name, $price, NULL);

			return ['data' => $car, 'view' => $view, 'message' => "Car created:" ];
		}
	}

	public function edit($id) 
	{
		if(is_numeric($id) && !empty($id)) {
			$view = '../views/car/edit.php';
			$params = [':id' => $id];
			$fuels = [];

			$getFuels = $this->model->select("SELECT id, name, price FROM fuel INNER JOIN car_fuel ON fuel.id=car_fuel.fuel_id WHERE car_id=:id", $params);
			foreach($getFuels as $fuel) {
				array_push($fuels, new Fuel($fuel['id'], $fuel['name'], $fuel['price']));
			}

			$car = $this->model->select("SELECT id, name, price FROM car WHERE id=:id", $params);
			$data = new Car($car[0]['id'], $car[0]['name'], $car[0]['price'], $fuels);

        	return ['data' => $data, 'view' => $view];
		}
	}

	public function update($id, $name, $price)
	{
		if( (is_numeric($id) && !empty($id)) && !empty(trim($name)) && !empty(trim($price)) ) {
			$params = [':name' => $name, ':price' => $price, ':id' => $id];
			$params1 = ['id' => $id ];

			$isUpdated = $this->model->update("UPDATE car SET name=:name, price=:price WHERE id=:id", $params);
			if($isUpdated) {
				$view = '../views/car/show.php';
				$fuels = [];

				$getFuels = $this->model->select("SELECT id, name, price FROM fuel INNER JOIN car_fuel ON fuel.id=car_fuel.fuel_id WHERE car_id=:id", $params1);
				foreach($getFuels as $fuel) {
					array_push($fuels, new Fuel($fuel['id'], $fuel['name'], $fuel['price']));
				}

				$car = new Car($id, $name, $price, $fuels);
				return ['data' => $car, 'view' => $view, 'message' => 'Updated successfully'];
			}
		}
	}

	public function delete($id)
	{
		if(!empty($id) && is_numeric($id)) {
			$params = [':id' => $id];
			$view = '../views/car/delete.php';

			$isDeleted = $this->model->delete("DELETE FROM car WHERE id=:id", $params);
			if($isDeleted) {
				$sql = "DELETE FROM car_fuel WHERE car_id=:id";
				$this->model->delete($sql, $params);
				return ['id' => $id, 'view' => $view, 'message' => "Car deleted! ID:"]; 
			}
		}
	}

	public function addFuel($id)
	{
		if(is_numeric($id)) {
			$fuels = [];
			$params = [':id' => $id];
			$view = '../views/car/addFuelToCar.php';

			$addedFuels = $this->model->select("SELECT id, name, price FROM fuel INNER JOIN car_fuel ON fuel.id=car_fuel.fuel_id WHERE car_id=:id", $params);

			if(!empty($addedFuels)) {
				$sql = "SELECT id, name, price FROM fuel WHERE id NOT IN (";
				foreach($addedFuels as $key => $fuel){
					if(count($addedFuels)-1 == $key) {
						$sql .= $fuel['id'];
					} else {
		         		$sql .= $fuel['id'] . ", ";
					}
		        }
		        $sql .= " )";

	        	$missingFuels = $this->model->select($sql);
		    } else {
		    	$missingFuels = $this->model->select("SELECT id, name, price FROM fuel");
		    }
	        foreach($missingFuels as $fuel) {
	        	array_push($fuels, new Fuel($fuel['id'], $fuel['name'], $fuel['price']));
	        }

	        return ['fuels' => $fuels, 'carId' => $id, 'view' => $view ];
		}
	}

	public function connectCarFuel($id, $fuelId)
	{
		if(is_numeric($id) && is_numeric($fuelId)) {
			$params = [':car_id' => $id, ':fuel_id' => $fuelId];
			$view = '../views/car/connectCarFuel.php';

			$sql = "INSERT INTO car_fuel (car_id, fuel_id) VALUES (:car_id, :fuel_id)";
			$result = $this->model->insertConnect($sql, $params);
			if($result) {
				return ['view' => $view, 'car_id' => $id, 'fuel_id' => $fuelId ];
			}
		}
	}

	public function removeCarFuel($id, $fuelId) 
	{
		if(is_numeric($id) && is_numeric($fuelId)) {
			$params = [':car_id' => $id, ':fuel_id' => $fuelId];
			$view = '../views/car/removeCarFuel.php';
			$sql = "DELETE FROM car_fuel WHERE car_id=:car_id AND fuel_id=:fuel_id";
			$result = $this->model->delete($sql, $params);
			if($result) {
				return ['view' => $view, 'car_id' => $id, 'fuel_id' => $fuelId];
			}
		}
	}
}
