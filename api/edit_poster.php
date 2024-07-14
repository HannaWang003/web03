<?php
include_once "db.php";
$table = "poster";
$DB = ${ucfirst($table)};
foreach ($_POST['id'] as $idx => $id) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $DB->del($id);
    } else {
        $row = $DB->find($id);
        if (isset($_POST['sh']) && in_array($id, $_POST['sh'])) {
            $row['sh'] = 1;
        } else {
            $row['sh'] = 0;
        }
        $row['name'] = $_POST['name'][$idx];
        $row['ani'] = $_POST['ani'][$idx];
        $DB->save($row);
    }
}
to("../back.php?do=$table");