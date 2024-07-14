<?php
include_once "db.php";
switch ($_POST['type']) {
    case "date":
        $Order->del(['date' => $_POST['date']]);
        break;
    case "movie":
        $Order->del(['name' => $_POST['name']]);
        break;
}
to('../back.php?do=order');
