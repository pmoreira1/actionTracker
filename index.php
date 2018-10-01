<?php

//hold all api calls
use \Psr\Http\Message\ServerRequestInterface as Request;
require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);

$app->post("/sleep", function ($request, $response) {
    include 'includes/functions.php';
    $db = new Db();
    $q = "INSERT INTO `smoke`.`dayActions` (`action`) VALUES (2)";
    $db->query($q);
});

$app->run();
