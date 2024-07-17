<?php
include_once "db.php";
if ($Order->count(['orderdate' => date("Y-m-d")]) > 0) {
    $max = $Order->max('no', ['orderdate' => date("Y-m-d")]);
    echo $_POST['no'] = (int)$max + 1;
} else {
    echo $_POST['no'] = date("Ymd") . "0001";
}
$_POST['orderdate'] = date("Y-m-d");
sort($_POST['seat']);
$_POST['seat'] = serialize($_POST['seat']);
$Order->save($_POST);
