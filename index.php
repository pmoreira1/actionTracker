<?php

//hold all api calls
use \Psr\Http\Message\ServerRequestInterface as Request;
require 'vendor/autoload.php';
include 'includes/functions.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
    ],
]);
$app->post("/wake", function ($request, $response) {
    $db = new Db();
    $q = "INSERT INTO `dayActions` (`action`) VALUES (1)";
    $db->query($q);
});

$app->post("/sleep", function ($request, $response) {
    $db = new Db();
    $q = "INSERT INTO `dayActions` (`action`) VALUES (2)";
    $db->query($q);
});
$app->post("/smoke", function ($request, $response) {
    $db = new Db();
    $data = $request->getParsedBody();
    $location = $data['loc'];
    $q = "INSERT INTO `dayActions` (`action`,`location`) VALUES (4," . $db->quote($location) . ")";
    $db->query($q);
});
$app->post("/coffee", function ($request, $response) {
    $db = new Db();
    $data = $request->getParsedBody();
    $location = $data['loc'];
    $q = "INSERT INTO `dayActions` (`action`,`location`) VALUES (5," . $db->quote($location) . ")";
    $db->query($q);
});
$app->post("/newPack", function ($request, $response) {
    $db = new Db();
    $q = "INSERT INTO `dayActions` (`action`) VALUES (6)";
    $db->query($q);
});

$app->get("/home", function ($request, $response) {
/**GET HOME PAGE DETAILS */

});
$app->run();
