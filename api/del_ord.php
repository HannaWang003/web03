<?php
include_once "db.php";
switch ($_POST['type']) {
    case "date":
        $Order->del(['date' => $_POST['date']]);
        break;
    case "movie":
        $Order->del(['movie' => $_POST['movie']]);
}
to("../back.php?do=order");
