<?php
include_once "db.php";
if (isset($_POST['type'])) {
    $type = $_POST['type'];
    unset($_POST['type']);
    switch ($type) {
        case "date":
            unset($_POST['movie']);
            break;
        case "movie":
            unset($_POST['date']);
    }
}
$DB->del($_POST);
to("../back.php?do=$table");
