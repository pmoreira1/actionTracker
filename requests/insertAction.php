<?php

include '../includes/functions.php';

if ($_POST['action'] == 'sleep') {
    $q = "INSERT INTO `smoke`.`dayActions` (`action`) VALUES (2)";
}

if ($_POST['action'] == 'wake') {
    $q = "INSERT INTO `smoke`.`dayActions` (`action`) VALUES (1)";
}
