<?php
include_once "db.php";
$_POST['sh'] = ($_POST['sh'] == 1) ? "0" : "1";
$DB->save($_POST);
