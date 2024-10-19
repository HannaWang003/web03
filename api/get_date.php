<?php
include_once "db.php";
$m = $DB->find($_POST);
$d = $DB->date($m['ondate']);
for ($i = 0; $i <= $d['diff']; $i++) {
    $day = date("Y-m-d", strtotime("+$i days"));
?>
    <option value="<?= $day ?>"><?= $day ?></option>
<?php
}
?>