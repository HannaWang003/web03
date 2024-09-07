<?php
include_once "db.php";
$_POST['orderdate'] = date("Y-m-d");
$max = $Order->max('no', ['orderdate' => date("Y-m-d")]);
if ($max != "") {
    $_POST['no'] = $max + 1;
} else {
    $_POST['no'] = date("Ymd") . "0001";
}
$_POST['seats'] = serialize($_POST['seats']);
$Order->save($_POST);