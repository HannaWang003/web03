<?php
include_once "db.php";
$row = $Movie->find($_POST['movie']);
$ondate = strtotime($row['ondate']);
$end = strtotime("+2 days", $ondate);
$today = strtotime(date("Y-m-d"));
$diff = ($end - $today) / (60 * 60 * 24);
for ($i = 0; $i <= $diff; $i++) {
    $day = date("Y-m-d", strtotime("+$i days"));
?>
    <option value="<?= $day ?>"><?= $day ?></option>
<?php
};
?>