<?php

use Slim\Factory\AppFactory;

use App\Middlewares\AuthMiddleware;

use function App\RestAPI\AddRestAPI;
use function App\Web\AddWeb;

use function SetupServices;

require_once(__DIR__ . '/vendor/autoload.php');
require_once(__DIR__ . '/services.php');

// Init the services
$services = SetupServices();

// Init the app
$app = AppFactory::create();

// Add middlewares
$authMiddleware = new AuthMiddleware();
$app->add($authMiddleware);

// Setup the RestAPI
AddRestAPI($app, $services);

// Setup the web
AddWeb($app, $services);

// Return the app
return $app;
