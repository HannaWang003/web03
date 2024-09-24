<?php
include_once "db.php";
if (!empty($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/{$_FILES['img']['name']}");
    $_POST['img'] = $_FILES['img']['name'];
}
$_POST['ani'] = rand(1, 3);
$max = $DB->max('rank');
$_POST['rank'] = ($max != "") ? $max + 1 : 1;
$DB->save($_POST);
to("../back.php?do=$table");
