<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->add( function(Request $request, Response $response, $next) {
  
    $params = $request->getParams();

    if(!$params['user'])
    {
        throw new Exception('No tienes Acceso - verifica que tu usuario sea correcto');
    }
    
    return $next($request, $response);
    
});
