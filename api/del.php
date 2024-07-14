<?php
include_once "db.php";
$table = $_GET['table'];
$DB = ${ucfirst($table)};
$DB->del($_GET['id']);
