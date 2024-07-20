<?php
include_once "db.php";
$H = date("G");
$start = ($H >= 14) ? 5 - ceil((24 - $H) / 2) + 1 : 0;
for ($i = $start; $i < 5; $i++) {
    $qt = $Order->sum('qt', ['movie' => $_GET['movie'], 'date' => $_GET['date'], 'session' => $sess[$i]]);
    $lav = 20 - $qt;
?>
    <option value="<?= $sess[$i] ?>"><?= $sess[$i] ?> 剩餘座位 <?= $lav ?></option>
<?php
}
?>