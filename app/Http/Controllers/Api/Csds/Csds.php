<?php

use ly\Csds;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/api/csds', function(Request $request, Response $response) {

    $csds = new Csds;

    if ($csds::all()->isEmpty()) {

        throw new Exception('No hay registros');
    }

    $csds = $csds::all();
    
    $response = $this->response->withStatus(200)
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode($csds));
    
    return $response;

});
