<?php
include_once "db.php";
if (!empty($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/{$_FILES['img']['name']}");
    $_POST['img'] = $_FILES['img']['name'];
}
$max = $DB->max('rank');
if ($max != "") {
    $_POST['rank'] = $max + 1;
} else {
    $_POST['rank'] = 1;
}
$_POST['ani'] = rand(1, 3);
$DB->save($_POST);
to("../back.php?do=poster");