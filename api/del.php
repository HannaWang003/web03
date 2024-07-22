<?php
include_once "db.php";
$table = $_POST['table'];
$DB = ${ucfirst($table)};
$DB->del($_POST['id']);
