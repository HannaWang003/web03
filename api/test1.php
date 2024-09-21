<?php
include_once "db.php";
$date = date("Ymd");
$max = $Order->max('no', " where no like '$date%'");
$_POST['no'] = ($max == "") ? date("Ymd") . rand(0001, 9999) : $max + 1;
// $_POST['no'] = date("Ymd") . "0001";
$_POST['movie'] = "電影(一)";
$_POST['date'] = "2024-09-22";
$_POST['session'] = "16:00~18:00";
$_POST['qt'] = 4;
$_POST['seats'] = serialize([1, 2, 3, 4]);
$Order->save($_POST);
