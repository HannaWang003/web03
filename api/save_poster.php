<?php
include_once "db.php";
if (!empty($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/{$_FILES['img']['name']}");
    $_POST['img'] = $_FILES['img']['name'];
}
if (!isset($_POST['id'])) {
    $_POST['rank'] = $Movie->max('rank') + 1;
    $Poster->save($_POST);
} else {
    foreach ($_POST['id'] as $idx => $id) {
        if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
            $Poster->del($id);
        } else {
            $row = $Poster->find($id);
            if (isset($_POST['sh']) && in_array($id, $_POST['sh'])) {
                $row['sh'] = 1;
            } else {
                $row['sh'] = 0;
            }
            $row['name'] = $_POST['name'][$idx];
            $Poster->save($row);
        }
    }
}

to("../back.php?do=poster    ");
