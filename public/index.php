<?php
// Enlace entre el backend y el frontend
require __DIR__ . '/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Responce;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();
$router = new \Bramus\Router\Router();
require __DIR__ . '/../app/Routes/web.php';
$request = Request::createFromGlobals();
$response = new Response();

$router->run();
$response->send();

?>