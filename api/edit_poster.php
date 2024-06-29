<?php
include_once "db.php";
foreach ($_POST['id'] as $idx => $id) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $Poster->del($id);
    } else {
        $row = $Poster->find($id);
        $row['name'] = $_POST['name'][$idx];
        $row['ani'] = $_POST['ani'][$idx];
        if (isset($_POST['sh']) && in_array($row['id'], $_POST['sh'])) {
            $row['sh'] = 1;
        } else {
            $row['sh'] = 0;
        }
        $Poster->save($row);
    }
}
to("../back.php?do=poster");
