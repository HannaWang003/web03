<?php
include_once "db.php";
$H = date("G");
$date = $_GET['date'];
$today = date("Y-m-d");
$start = ($H >= 14 && ($date == $today)) ? 6 - ceil((24 - $H) / 2) : "0";
if ($H >= 22 && $date == $today) {
?>
<option value="0">今日已無可供訂購場次</option>
<?php
} else {
    for ($i = $start; $i < 5; $i++) {
        $qt = 20 - $Order->sum('qt', ['movie' => $_GET['movie'], 'date' => $date, 'session' => $sess[$i]]);
    ?>
<option value="<?= $sess[$i] ?>"><?= $sess[$i] ?>剩餘座位 <?= $qt ?></option>;
<?php
    }
}
?>