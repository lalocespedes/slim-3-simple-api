<?php

$container = $app->getContainer();

// Database
$container['capsule'] = function ($c) {

    $capsule = new Illuminate\Database\Capsule\Manager;

    $capsule->addConnection([
        'driver' => 'mysql',
        'host' => getenv('IP'),
        'database' => getenv('DB_DATABASE'),
        'username' => getenv('C9_USER'),
        'password' => getenv('DB_PASSWORD'),
        'charset' => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix' => ''
    ]);

    return $capsule;

};

$container['errorHandler'] = function ($c) {

    return function ($request, $response, $exception) use ($c) {

        $c->logger->error($exception->getMessage());

        return $c['response']->withStatus(404)
            ->withHeader('Content-Type', 'text/html')
            ->write($exception->getMessage());
    };
};

// monolog
$container['logger'] = function ($c) {

    $logger = new \Monolog\Logger('ly');
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler('./log/'.getenv('APP_LOG').'.log', \Monolog\Logger::DEBUG));

    return $logger;

};
