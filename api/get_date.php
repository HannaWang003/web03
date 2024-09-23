<?php
include_once "db.php";
$ondate = strtotime($DB->find($_POST)['ondate']);
$enddate = strtotime("+2 days", $ondate);
$today = strtotime(date("Y-m-d"));
$diff = ($enddate - $today) / (60 * 60 * 24);
for ($i = 0; $i <= $diff; $i++) {
    $day = date("Y-m-d", strtotime("+$i days"));
?>
    <option value="<?= $day ?>"><?= $day ?></option>
<?php
}
