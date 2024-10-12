<?php
include_once "db.php";
$today = date("Ymd");
$max = ($DB->max("no", "where `no` like '$today%'")) ?? $today . "0000";
echo $_POST['no'] = $max + 1;
$_POST['seat'] = serialize($_POST['seat']);
$DB->save($_POST);
