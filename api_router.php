<?php
require_once 'libs/router/router.php';
require_once 'app/controllers/genres-api.controller.php';


$router = new Router();

$router->addRoute('genres',     'GET',      'GenresApiController', 'getGenres');
$router->addRoute('genres/:id',  'GET',      'GenresApiController', 'getGenre');
$router->addRoute('genres/:id',  'DELETE',   'GenresApiController', 'deleteGenre');
$router->addRoute('genres',      'POST',     'GenresApiController', 'insertGenre');
$router->addRoute('genres/:id',  'PUT',      'GenresApiController', 'updateGenre');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
