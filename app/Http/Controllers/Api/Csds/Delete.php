<?php

use ly\Csds;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->delete('/api/csds/{id}', function(Request $request, Response $response, $args) {
    
    $csd = Csds::findOrFail($args['id']);
    $csd->delete();

    $response = $this->response->withStatus(200)
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode([
                'message' => 'Csd eliminado'
            ]));
    
    return $response;
    
});
