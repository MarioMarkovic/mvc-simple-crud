<?php 
require_once(realpath(dirname(__FILE__) . '/../core/Model.php'));
require_once(realpath(dirname(__FILE__) . '/../models/Fuel.php'));

class FuelController 
{
	private $model;

	public function __construct()
	{
		$this->model = new Model;
	}

	public function index()
	{
		$data = [];
		$view = '../views/fuel/index.php';
		$fuels = $this->model->select("SELECT id, name, price FROM fuel");
		foreach($fuels as $fuel){
            array_push($data, new Fuel($fuel['id'], $fuel['name'], $fuel['price']));
        }

        return ['data' => $data, 'view' => $view];
	}

	public function show($id)
	{
		if(is_numeric($id) && !empty($id)) {
			$data = [];
			$view = '../views/fuel/show.php';
			$fuel = $this->model->select("SELECT id, name, price FROM fuel WHERE id=:id", ['id' => $id]);

            $data = new Fuel($fuel[0]['id'], $fuel[0]['name'], $fuel[0]['price']);
        	return ['data' => $data, 'view' => $view];
		}
	}

	public function create()
	{
		$view = '../views/fuel/create.php';
	    return ['view' => $view];
	}

	public function insert($name, $price)
	{
		if(!empty(trim($name)) && !empty(trim($price))) {
			$sql = "INSERT INTO fuel (name, price) VALUES (:name, :price)";
			$params = [ ':name' => $name, ':price' => $price ];
			$view = '../views/fuel/show.php';

			$fuelId = $this->model->insert($sql, $params);
			$fuel = new Fuel($fuelId, $name, $price);

			return ['data' => $fuel, 'view' => $view, 'message' => "Fuel created:" ];
		}
	}

	public function edit($id) 
	{
		if(is_numeric($id) && !empty($id)) {
			$view = '../views/fuel/edit.php';
			$params = [':id' => $id];
			$fuel = $this->model->select("SELECT id, name, price FROM fuel WHERE id=:id", $params);
            $data = new Fuel($fuel[0]['id'], $fuel[0]['name'], $fuel[0]['price']);
        	return ['data' => $data, 'view' => $view];
		}
	}

	public function update($id, $name, $price)
	{
		if( (is_numeric($id) && !empty($id)) && !empty(trim($name)) && !empty(trim($price)) ) {
			$params = [':name' => $name, ':price' => $price, ':id' => $id];

			$isUpdated = $this->model->update("UPDATE fuel SET name=:name, price=:price WHERE id=:id", $params);
			if($isUpdated) {
				$view = '../views/fuel/show.php';
				$fuel = new Fuel($id, $name, $price);
				return ['data' => $fuel, 'view' => $view, 'message' => 'Updated successfully'];
			}
		}
	}

	public function delete($id)
	{
		if(!empty($id) && is_numeric($id)) {
			$sql = "DELETE FROM fuel WHERE id=:id";
			$params = [':id' => $id];
			$view = '../views/fuel/delete.php';

			$isDeleted = $this->model->delete($sql, $params);
			if($isDeleted) {
				return ['id' => $id, 'view' => $view, 'message' => "Fuel deleted! ID:"]; 
			}
		}
	}
}
