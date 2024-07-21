<?php
include_once "db.php";
$table = $_POST['table'];
$DB = ${ucfirst($table)};
$row = $DB->find($_POST['id']);
$row['sh'] = ($row['sh'] == 1) ? 0 : 1;
$DB->save($row);
