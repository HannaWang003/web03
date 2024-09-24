<?php
include_once "db.php";
$row = $DB->find($_POST);
$today = strtotime(date("Y-m-d"));
$ondate = strtotime($row['ondate']);
$enddate = strtotime("+2 days", $ondate);
$diff = ($enddate - $today) / (60 * 60 * 24);
for ($i = 0; $i <= $diff; $i++) {
    $day = date("Y-m-d", strtotime("+$i days"));
?>
    <option value="<?= $day ?>"><?= $day ?></option>
<?php
}
?>