<?php
include_once "db.php";
$today = date("Ymd");
$max = $Order->max('no', "where `no` like '$today%'");
echo $_POST['no'] = ($max == "") ? date("Ymd") . "0001" : $max + 1;
$_POST['seats'] = serialize($_POST['seats']);
$DB->save($_POST);
