<?php
include_once "db.php";
$id = $Order->max('id', ['date' => $_POST['date']]) + 1;
echo $_POST['no'] = date("Ymd") . sprintf("%04d", $id);
sort($_POST['seats']);
$_POST['seats'] = serialize($_POST['seats']);
$Order->save($_POST);
