<?php
include_once "db.php";
$table = $_GET['table'];
$DB = ${ucfirst($table)};
$row = $DB->find($_GET['id']);
$row['sh'] = ($_GET['sh'] == 1) ? 0 : 1;
$DB->save($row);
