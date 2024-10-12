<?php
include_once "db.php";
$today = strtotime(date("Y-m-d"));
$ondate = strtotime($Movie->find($_POST)['ondate']);
$endate = strtotime("+2 days", $ondate);
$diff = ($endate - $today) / (60 * 60 * 24);
for ($i = 0; $i <= $diff; $i++) {
    $date = date("Y-m-d", strtotime("+$i days"));
?>
    <option value="<?= $date ?>"><?= $date ?></option>
<?php
}
