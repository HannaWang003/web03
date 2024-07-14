<?php
include_once "db.php";
$table = $_GET['table'];
$DB = ${ucfirst($table)};
$now = $DB->find($_GET['id']);
$sw = $DB->find($_GET['sw']);
echo $tmp = $now['rank'];
$now['rank'] = $sw['rank'];
echo $sw['rank'] = $tmp;
$DB->save($now);
$DB->save($sw);
