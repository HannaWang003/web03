<?php
include_once "db.php";
if (!empty($_FILES['poster']['tmp_name'])) {
    move_uploaded_file($_FILES['poster']['tmp_name'], "../img/{$_FILES['poster']['name']}");
    $_POST['poster'] = $_FILES['poster']['name'];
}
if (!empty($_FILES['trailer']['tmp_name'])) {
    move_uploaded_file($_FILES['trailer']['tmp_name'], "../img/{$_FILES['trailer']['name']}");
    $_POST['trailer'] = $_FILES['trailer']['name'];
}
$_POST['ondate'] = join("-", array($_POST['year'], $_POST['month'], $_POST['day']));
unset($_POST['year'], $_POST['month'], $_POST['day']);
$DB->save($_POST);
to("../back.php?do=$table");
