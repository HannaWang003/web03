<?php
include_once "db.php";
if (isset($_POST['type'])) {
    switch ($_POST['type']) {
        case "movie":
            $Order->del(['movie' => $_POST['movie']]);
            break;
        case "date":
            $Order->del(['date' => $_POST['date']]);
            break;
    }
} else {
    $Order->del($_GET['id']);
}
to("../back.php?do=order");