<?php 
require_once(realpath(dirname(__FILE__) . '/CarController.php'));
require_once(realpath(dirname(__FILE__) . '/FuelController.php'));

class RouteController 
{	
	// controllers
	public $car;
	public $fuel;

	// url params
	public $type 	= "";
	public $action 	= "";
	public $id 		= "";
	public $fuelId  = "";

	public function __construct()
	{
		$this->car 	= new CarController;
		$this->fuel = new FuelController;

		if(isset($_GET['type']) && !empty(trim($_GET['type']))) {
			$this->type = $_GET['type'];
		}
		if(isset($_GET['action']) && !empty(trim($_GET['action']))) {
			$this->action = $_GET['action'];
		}
		if(isset($_GET['id']) && !empty(trim($_GET['id']))) {
			$this->id = $_GET['id'];
		}
		if(isset($_GET['fuelId']) && !empty(trim($_GET['fuelId']))) {
			$this->fuelId = $_GET['fuelId'];
		}
	}

	public function showData() 
	{
		if($this->type == "") {
			// default index page
			$data = $this->car->index();
			require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));

			$data = $this->fuel->index();
			require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
			
		} else {
			if($this->type == "car") {
				switch ($this->action) {
					case 'show':
						$data = $this->car->show($this->id);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'create':
						$data = $this->car->create();
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'insert':
						$data = $this->car->insert($_POST['name'], $_POST['price']);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'edit':
						$data = $this->car->edit($this->id);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'update':
						$data = $this->car->update($this->id, $_POST['name'], $_POST['price']);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'delete':
						$data = $this->car->delete($this->id);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'addFuel':
						$data = $this->car->addFuel($this->id);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'connectCarFuel':
						$data = $this->car->connectCarFuel($this->id, $this->fuelId);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'removeCarFuel':
						$data = $this->car->removeCarFuel($this->id, $this->fuelId);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					default:
						$data = $this->car->index();
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
				}
			}

			if($this->type == "fuel") {
				switch ($this->action) {
					case 'show':
						$data = $this->fuel->show($this->id);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'create':
						$data = $this->fuel->create();
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'insert':
						$data = $this->fuel->insert($_POST['name'], $_POST['price']);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'edit':
						$data = $this->fuel->edit($this->id);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'update':
						$data = $this->fuel->update($this->id, $_POST['name'], $_POST['price']);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					case 'delete':
						$data = $this->fuel->delete($this->id);
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
					default:
						$data = $this->fuel->index();
						require_once(realpath(dirname(__FILE__) . '/' . $data['view'] ));
						break;
				}
			}
		}
	}
}