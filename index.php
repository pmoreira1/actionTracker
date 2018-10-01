<?php

//hold all api calls
use \Psr\Http\Message\ServerRequestInterface as Request;

require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);
$app->get("/hello", function ($request, $response) {
    $result = 'hi';
    return $response->withJson($result, 200);

});

$app->post("/sleep", function ($request, $response) {
    $data = $request->getParsedBody();
    print_r($data);
});

$app->run();
