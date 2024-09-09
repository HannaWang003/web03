<?php
include_once "db.php";
$row = $DB->find($_GET['id']);
$row['sh'] = ($_GET['sh'] == 1) ? 0 : 1;
$DB->save($row);