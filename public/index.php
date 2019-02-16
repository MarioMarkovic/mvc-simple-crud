<?php 
require_once(realpath(dirname(__FILE__) . '/../app/controllers/RouteController.php'));

$routeController = new RouteController;

$routeController->showData();
