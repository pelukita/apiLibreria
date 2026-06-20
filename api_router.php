<?php
require_once 'libs/router/router.php';


$router = new Router();

$router->addRoute('', 'GET', '', '');
$router->addRoute('/:id', 'GET', '', '');
$router->addRoute('', 'POST', '', '');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
