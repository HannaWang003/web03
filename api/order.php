<?php
include_once "db.php";
$no = $Order->max('no', ['orderdate' => date("Y-m-d")]);
$_POST['no'] = ($no == 0) ? date("Ymd") . "0001" : (int)$no + 1;
$_POST['orderdate'] = date("Y-m-d");
$_POST['seat'] = serialize($_POST['seat']);
$Order->save($_POST);
