<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/config_db.php';
$app = new \Slim\App;

// Engine Slim

require '../src/routes/gametasks.php';

$app->run();