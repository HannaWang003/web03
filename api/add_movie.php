<?php
include_once "db.php";
$table = $_POST['table'];
unset($_POST['table']);
$DB = ${ucfirst($table)};
if (!empty($_FILES['poster']['tmp_name'])) {
    move_uploaded_file($_FILES['poster']['tmp_name'], "./img/{$_FILES['poster']['name']}");
    $_POST['poster'] = $_FILES['poster']['name'];
}
if (!empty($_FILES['trailer']['tmp_name'])) {
    move_uploaded_file($_FILES['trailer']['tmp_name'], "./img/{$_FILES['trailer']['name']}");
    $_POST['trailer'] = $_FILES['trailer']['name'];
}
$_POST['ondate'] = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'];
unset($_POST['year'], $_POST['month'], $_POST['day']);
$_POST['rank'] = $DB->max('rank') + 1;
$DB->save($_POST);
to("../back.php?do=$table");
