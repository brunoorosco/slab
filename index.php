<?php

require 'vendor/autoload.php';
require 'App/lib/Db.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


if ($_SERVER['SERVER_NAME'] == 'localhost')
    require 'App/lib/config_dev.php';
else
    require 'App/lib/config_prod.php';
session_start();
//session_destroy();

// Conectar com o banco de dados
Db::conectar($dbname, $user, $password, $host);


$config = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true,

]];

$c = new \Slim\Container($config);
$app = new \Slim\App($c);

// Define app routes
require_once 'App/Controllers/controller.php';
//defina a rota
$app->get('/', function () { 
    Controller::index();
  }); 
$app->get('/empresa', function () { 
    Controller::empresa();
  }); 

$app->get('/login', function () { 
    Controller::login();
  }); 

$app->get('/ensaio', function () { 
    Controller::ensaio();
  }); 
$app->get('/users', function () { 
    Controller::ensaio();
  }); 
  //rode a aplicação Slim 
  $app->run();

