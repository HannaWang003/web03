<?php
include_once "db.php";
$today = date("Y-m-d");
$d = $DB->date($today);
$rows = $DB->all("where `sh`=1 && `ondate` between '{$d['ago']}' and '$today' ");
foreach ($rows as $row) {
?>
    <option value="<?= $row['name'] ?>" <?= ($row['id'] == $_POST['id']) ? "selected" : "" ?>><?= $row['name'] ?></option>
<?php
}
