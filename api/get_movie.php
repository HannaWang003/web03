<?php
include_once "db.php";
$today = date("Y-m-d");
$ago = date("Y-m-d", strtotime("-2 days"));
$rows = $DB->all("where `sh`=1 && `ondate` between '$ago' and '$today' order by rank");
foreach ($rows as $row) {
?>
    <option value="<?= $row['movie'] ?>" <?= ($row['id'] == $_POST['id']) ? "selected" : "" ?>><?= $row['movie'] ?></option>
<?php
}
?>