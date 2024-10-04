<?php
include_once "db.php";
$today = date("Y-m-d");
$ago = date("Y-m-d", strtotime("-2 days"));
$rows = $Movie->all("where `sh`='1' && `ondate` between '$ago' and '$today'");
foreach ($rows as $row) {
    $selected = ($row['id'] == $_POST['id']) ? "selected" : "";
?>
    <option value="<?= $row['name'] ?>" <?= $selected ?>><?= $row['name'] ?></option>
<?php
}
