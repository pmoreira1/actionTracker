<?php

require 'db.php';
require 'actionClass.php';


function seconds2human($ss)
{
    $s = $ss % 60;
    $m = floor(($ss % 3600) / 60);
    $h = floor(($ss % 86400) / 3600);
    $d = floor(($ss % 2592000) / 86400);
    if ($h < 10) {
        $h = "0" . $h;
    }
    if ($m < 10) {
        $m = "0" . $m;
    }
    if ($s < 10) {
        $s = "0" . $s;
    }
    if ($d > 0) {
        if ($d > 1) {
            return "$d days $h:$m:$s";
        } else {
            return "$d day $h:$m:$s";
        }
    } else {
        return "$h:$m:$s";
    }
}
