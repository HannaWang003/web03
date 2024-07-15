<?php
include_once "db.php";
$date = $_GET['date'];
$today = date("Y-m-d");
$H = date("G");
$start = ($date == $today && $H >= 14) ? $start = 5 - ceil((24 - $H) / 2) + 1 : "0";
for ($i = $start; $i < 5; $i++) {
    $qt = $Order->sum('qt', ['date' => $date, 'name' => $_GET['movie'], 'session' => $sess[$i]]);
    $lav = 20 - $qt;
?>
    <option value="<?= $sess[$i] ?>"><?= $sess[$i] ?> - 剩於座位 <?= $lav ?></option>
<?php
}
