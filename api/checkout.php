<?php
include_once "db.php";
$_POST['seats'] = serialize($_POST['seats']);
$today = date("Ymd");
$max = $Order->max('no', "where `no` like '$today%'");
echo $_POST['no'] = ($max > 0) ? $max + 1 : $today . "0001";
$Order->save($_POST);
