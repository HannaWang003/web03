<?php
include_once "db.php";
$_POST['seats'] = serialize($_POST['seats']);
$today = date("Ymd");
$no = $DB->max('no', "where `no` like '$today%'");
echo $_POST['no'] = ($no == 0) ? $today . "0001" : $no + 1;
$DB->save($_POST);
