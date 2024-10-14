<?php
include_once "db.php";
if (!isset($_POST['id'])) {
    $_POST['rank'] = $DB->max('rank') + 1;
    if (!empty($_FILES['img']['tmp_name'])) {
        move_uploaded_file($_FILES['img']['tmp_name'], "../img/{$_FILES['img']['name']}");
        $_POST['img'] = $_FILES['img']['name'];
    }
    $_POST['ani'] = rand(1, 3);
    $DB->save($_POST);
} else {
    foreach ($_POST['id'] as $idx => $id) {
        if ($_POST['del'] && in_array($id, $_POST['del'])) {
            $DB->del($id);
        } else {
            $row = $DB->find($id);
            $row['name'] = $_POST['name'][$idx];
            $row['ani'] = $_POST['ani'][$idx];
            $row['sh'] = ($_POST['sh'] && in_array($id, $_POST['sh'])) ? 1 : 0;
            $DB->save($row);
        }
    }
}
to("../back.php?do=$do");
