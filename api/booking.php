<?php
include_once "db.php";
$now = date("Ymd");
$max = $Order->max('no', "where no LIKE '$now%'");
if ($max != "") {
    echo $_POST['no'] = $max + 1;
} else {
    echo $_POST['no'] = date("Ymd") . "0001";
}
$_POST['seats'] = serialize($_POST['seats']);
$Order->save($_POST);