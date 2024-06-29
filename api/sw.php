<?php
include_once "db.php";
$DB = ${ucfirst($_POST['table'])};
$now = $DB->find($_POST['id']);
$tmp = $now['rank'];
$sw = $DB->find($_POST['sw']);
$now['rank'] = $sw['rank'];
$sw['rank'] = $tmp;
$DB->save($now);
$DB->save($sw);
