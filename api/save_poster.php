<?php
include_once "db.php";
if (!isset($_POST['id'])) {
    $_POST['rank'] = $Poster->max('rank') + 1;
    if (!empty($_FILES['img']['tmp_name'])) {
        move_uploaded_file($_FILES['img']['tmp_name'], "../img/{$_FILES['img']['name']}");
        $_POST['img'] = $_FILES['img']['name'];
        $Poster->save($_POST);
    }
} else {
    foreach ($_POST['id'] as $idx => $id) {
        if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
            $Poster->del($id);
        } else {
            $row = $Poster->find($id);
            $row['name'] = $_POST['name'][$idx];
            $row['ani'] = $_POST['ani'][$idx];
            $row['sh'] = (isset($_POST['sh']) && in_array($id, $_POST['sh'])) ? 1 : 0;
            $Poster->save($row);
        }
    }
}
to("../back.php?do=poster");
