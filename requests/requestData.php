<?php

include '../includes/functions.php';

if (date('H') > 0 && date('H') < 5) {
    /* show yesterday */
    $date = date('Y-m-d', strtotime('yesterday'));
    $yesterday = date('Y-m-d H:i:s', strtotime('48 hours ago'));
    $yesterdayDate = date('Y-m-d', strtotime($yesterday));
} else {
    /* show today */
    $date = date('Y-m-d', strtotime('today'));
    $yesterday = date('Y-m-d H:i:s', strtotime('24 hours ago'));
    $yesterdayDate = date('Y-m-d', strtotime($yesterday));
}
$start = date("Y-m-d 05:00:00", strtotime($date));
$end = date("Y-m-d 04:59:59", strtotime($start . " + 24 hours"));
$yesterdayStart = date("Y-m-d H:i:s", strtotime("$start - 24 hours"));
$yesterdayEnd = date("Y-m-d H:i:s", strtotime("$end - 24 hours"));
$records = $dates = array();
$result['todayTotal'] = $db->select("SELECT  COUNT(*) AS total FROM record WHERE `datetime` BETWEEN '$start' AND '$end'")[0];
$result['yesterdayTotal'] = $db->select("SELECT  COUNT(*) AS total FROM record WHERE `datetime` BETWEEN '$yesterdayStart' AND '$yesterdayEnd'")[0];
$result['yesterdayAtCurrentTime'] = $db->select("SELECT COUNT(*) AS total FROM record WHERE DATE(`datetime`) = '$yesterdayDate' and HOUR(`datetime`) > 5 and `datetime`< '$yesterday'")[0];
$result['last'] = seconds2human(strtotime('now') - strtotime($db->select("SELECT * FROM record order by `datetime` desc limit 1")[0]['datetime']));
$result['lastSeconds'] = strtotime('now') - strtotime($db->select("SELECT * FROM record order by `datetime` desc limit 1")[0]['datetime']);
$result['diffFromYesterday'] = $result['todayTotal']['total'] - $result['yesterdayAtCurrentTime']['total'];

$i = 0;
$nDays = 15;
for ($i = 0; $i <= $nDays; $i++) {
    $startTime = $dates[$i]['startTime'] = date("Y-m-d 05:00:00", strtotime("today - $i days"));
    $endTime = $dates[$i]['endTime'] = date("Y-m-d 04:59:59", strtotime($dates[$i]['startTime'] . " + 24 hours"));
    $dates[$i]['date'] = date("Y-m-d", strtotime($dates[$i]['startTime']));
    $dates[$i]['qty'] = $db->select("SELECT COUNT(*) AS total FROM record WHERE `datetime` BETWEEN '$startTime' AND '$endTime'")[0]['total'];
    $dates[$i]['query'] = "SELECT COUNT(*) AS total FROM record WHERE `datetime` BETWEEN '$startTime' AND '$endTime'";
}

$result['dates'] = $dates;
$result['gfxData'] = array_reverse($dates);
echo json_encode($result, true);
