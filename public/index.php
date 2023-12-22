<?php
//chargement des dépendances PHP
require_once '../vendor/autoload.php';

//Démarrage de session
session_start();

//chargement des variables d'environnements
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ .'/../');
$dotenv->load();

//chargement du Router
require_once '../core/Router.php';

//instancier notre router afin de rediriger notre utilisateur
$router = new Router();

//Nos routes
$router->add('/PHP/portfolio', 'HomeController', 'index');
$router->add('/PHP/portfolio/test', 'HomeController', 'test');
$router->add('/PHP/portfolio/contact', 'HomeController', 'contact');
$router->add('/PHP/portfolio/article', 'HomeController', 'article');

$router->add('/PHP/portfolio/fixtures', 'FixtureController', 'index');

$router->add('/PHP/portfolio/404', 'ErrorController', 'error404');

$router->add('/PHP/portfolio/login', 'AuthController', 'login');
$router->add('/PHP/portfolio/logout', 'AuthController', 'logout');

$router->add('/PHP/portfolio/admin', 'AdminController', 'index');
$router->add('/PHP/portfolio/add', 'AdminController', 'addNewArticle');
$router->add('/PHP/portfolio/edit', 'AdminController', 'edit');
$router->add('/PHP/portfolio/delete', 'AdminController', 'delete');


//dispatch
$router->dispatch($_SERVER['REQUEST_URI']);
