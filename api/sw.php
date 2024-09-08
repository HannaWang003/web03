<?php
include_once "db.php";
$now = $DB->find($_GET['id']);
$sw = $DB->find($_GET['sw']);
$tmp = $now['rank'];
$now['rank'] = $sw['rank'];
$sw['rank'] = $tmp;
$DB->save($now);
$DB->save($sw);