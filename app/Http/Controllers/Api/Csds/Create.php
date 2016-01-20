<?php

use ly\Csds;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use ly\Http\Validators\Csds as Validator;

$app->post('/api/csds', function(Request $request, Response $response) {
    
    $params = $request->getParams();

    $validator = new validator;

    $isValid = $validator->assert($params);

    if (!$isValid) {
    
        $json_array = [];
    
        foreach ($validator->errors() as $error) {
    
            if(!empty($error)){
    
                $json_array[] = $error;
            }
    
        }

        $response = $this->response->withStatus(404)
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode($json_array));

        return $response;
    }


    $csd = Csds::create($params);

    $response = $this->response->withStatus(200)
            ->withHeader('Content-type', 'application/json')
            ->write(json_encode([
                'message' => 'Csd capturado',
                'id' => $csd->id
            ]));
    
    return $response;
        
});
