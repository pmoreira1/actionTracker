<?php

include '../includes/functions.php';

if ($_POST['action'] == 'sleep') {
    $q = "INSERT INTO `smoke`.`dayActions` (`action`) VALUES (2)";
    $db->query($q);
}

if ($_POST['action'] == 'wake') {
    $q = "INSERT INTO `smoke`.`dayActions` (`action`) VALUES (1)";
    $db->query($q);
}

if($_POST['action'] == 'smoke') {
    $q = "INSERT INTO `smoke`.`record` (postData,location) values ('" . json_encode($_POST) . "','" . json_encode($_POST['location']) . "');";
    $db->query($q);
}
