<?php
include_once "db.php";
if (isset($_POST['id'])) {
    $DB->del($_POST);
} else {
    $type = $_POST['type'];
    unset($_POST['type']);
    switch ($type) {
        case "movie":
            unset($_POST['date']);
            break;
        case "date":
            unset($_POST['movie']);
            break;
    }
    $DB->del($_POST);
}
to("../back.php?do=$do");
