<?php
include_once "db.php";
$DB = ${ucfirst($_POST['table'])};
$now = $Poster->find($_POST['id']);
$tmp = $now['rank'];
$sw = $Poster->find($_POST['sw']);
$now['rank'] = $sw['rank'];
$sw['rank'] = $tmp;
$Poster->save($now);
$Poster->save($sw);
