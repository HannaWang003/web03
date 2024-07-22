<?php
include_once "db.php";
$id = $_GET['id'];
$today = date("Y-m-d");
$ondate = date("Y-m-d", strtotime("-2 days"));
$rows = $Movie->all(" where `sh`=1 && `ondate` between '$ondate' and '$today' ", "order by rank");
foreach ($rows as $row) {
?>
    <option value="<?= $row['name'] ?>" <?= ($row['id'] == $id) ? "selected" : "" ?>><?= $row['name'] ?></option>
<?php
}
