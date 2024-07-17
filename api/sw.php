<?php
include_once "db.php";
$table = $_GET['table'];
$DB = ${ucfirst($table)};
$now = $DB->find($_GET['id']);
$tmp = $now['rank'];
$sw = $DB->find($_GET['sw']);
$now['rank'] = $sw['rank'];
$sw['rank'] = $tmp;
$DB->save($now);
$DB->save($sw);
