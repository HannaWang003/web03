<?php
include_once "db.php";
$H = date("G");
$today = date("Y-m-d");
if ($_POST['date'] == $today) {
    if ($H >= 22) {
        $start = 5;
        $end = 5;
    } else {
        if ($H < 14) {
            $start = 0;
            $end = 4;
        } else {
            $start = 6 - ceil((24 - $H) / 2);
            $end = 4;
        }
    }
} else {
    $start = 0;
    $end = 4;
}
for ($i = $start; $i <= $end; $i++) {
    $_POST['session'] = $sess[$i];
    $qt = 20 - ($DB->sum('qt', $_POST));
?>
    <option value="<?= $sess[$i] ?>"><?= $sess[$i] ?> 剩餘座位 <?= $qt ?></option>
<?php
}
?>