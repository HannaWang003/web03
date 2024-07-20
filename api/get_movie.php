<?php
include_once "db.php";
$today = date("Y-m-d");
$ondate = date("Y-m-d", strtotime("-2 days"));
$rows = $Movie->all(" where `sh`=1 && `ondate` between '$ondate' and '$today'");
foreach ($rows as $row) {
?>
    <option value="<?= $row['name'] ?>" <?= ($row['id'] == $_GET['id']) ? "selected" : "" ?>><?= $row['name'] ?></option>
<?php
}
