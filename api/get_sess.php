<?php
include_once "db.php";
$H = date("G");
$today = date("Y-m-d");
if ($_POST['date'] == $today && $H >= 14) {
    $start = ($H >= 22) ? 5 : 6 - ceil((24 - $H) / 2);
    $end = ($H >= 22) ? 5 : 4;
} else {
    $start = 0;
    $end = 4;
}
for ($i = $start; $i <= $end; $i++) {
    $_POST['session'] = $sess[$i];
    $qt = 20 - $Order->sum('qt', $_POST);
?>
    <option value='<?= $sess[$i] ?>'>
        <?= $sess[$i] ?><?= ($i == 5) ? "" : "剩餘座位 $qt" ?>
    </option>;
<?php
}
