<?php
require_once 'libs/Router.php';
require_once 'app/controllers/apiGamesController.php';

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');





//crea el router
$router = new Router();

//define tabla de ruteo
$router->addRoute('games','GET','apiGamesController','getGames');
$router->addRoute('games/:ID','GET','apiGamesController','getGame');
$router->addRoute('games/:ID','DELETE','apiGamesController','deleteGame');
$router->addRoute('games','POST','apiGamesController','addGame');
$router->addRoute('games/:ID','PUT','apiGamesController','updateGame');

//rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
