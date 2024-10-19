<?php
include_once "db.php";
$id = $DB->find($_POST['id']);
$tmp = $id['rank'];
$sw = $DB->find($_POST['sw']);
$id['rank'] = $sw['rank'];
$sw['rank'] = $tmp;
$DB->save($id);
$DB->save($sw);
