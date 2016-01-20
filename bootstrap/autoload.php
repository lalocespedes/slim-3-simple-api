<?php

date_default_timezone_set('Mexico/General');

session_cache_limiter(false);

session_start();

require_once 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(dirname(__DIR__));
$dotenv->load();

ini_set('display_errors', getenv('APP_DEBUG'));

$app = new Slim\App();

//middleware
require_once 'bootstrap/middleware.php';

//dependencies
require_once 'bootstrap/dependencies.php';

//routes
require_once 'app/Http/routes.php';

// Register the database connection with Eloquent
$capsule = $app->getContainer()->get('capsule');
$capsule->bootEloquent();
