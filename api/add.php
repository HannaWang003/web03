<?php
include_once "db.php";
$table = $_POST['table'];
unset($_POST['table']);
$DB = ${ucfirst($table)};
if (!empty($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "./img/{$_FILES['img']['name']}");
    $_POST['img'] = $_FILES['img']['name'];
}
if ($table == "poster") {
    $_POST['ani'] = rand(1, 3);
}
$_POST['rank'] = $DB->max('rank') + 1;
$DB->save($_POST);
to("../back.php?do=$table");
