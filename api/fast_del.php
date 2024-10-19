<?php
include_once "db.php";
$type = $_POST['type'];
unset($_POST['type']);
switch ($type) {
    case "date":
        unset($_POST['name']);
        break;
    case "name":
        unset($_POST['date']);
        break;
}
$DB->del($_POST);
to("../back.php?do=$do");
