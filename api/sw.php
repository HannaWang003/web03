<?php
include_once "db.php";
$now = $DB->find($_POST['id']);
$sw = $DB->find($_POST['sw']);
$tmp = $now['rank'];
$now['rank'] = $sw['rank'];
$sw['rank'] = $tmp;
$DB->save($now);
$DB->save($sw);
