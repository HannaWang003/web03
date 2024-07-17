<?php
include_once "db.php";
$row = $Movie->find($_GET['id']);
$row['sh'] = ($row['sh'] == 0) ? 1 : 0;
$Movie->save($row);
