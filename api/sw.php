<?php
include_once "db.php";
$now = $Movie->find($_GET['id']);
$tmp = $now['rank'];
$sw = $Movie->find($_GET['sw']);
$now['rank'] = $sw['rank'];
$sw['rank'] = $tmp;
$Movie->save($now);
$Movie->save($sw);
