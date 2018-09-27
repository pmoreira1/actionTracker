<?php
/**Insert record on db for smoke */
include '../includes/functions.php';

$q = "INSERT INTO `smoke`.`record` (postData,location) values ('" . json_encode($_POST) . "','" . json_encode($_POST['location']) . "');";

$db->query($q);
