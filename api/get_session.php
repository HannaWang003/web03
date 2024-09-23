<?php
include_once "db.php";
$today = date("Y-m-d");
$H = date("G") + 1;
$start = ($_POST['date'] == $today && $H > 14) ? 5 - floor((24 - $H) / 2) : 0;
if ($_POST['date'] == $today && $H >= 22) {
?>
<option value="0">本日已無可訂購場次</option>
<?php
} else {
    for ($i = $start; $i <= 4; $i++) {
        $_POST['session'] = $session[$i];
        $qt = 20 - ($Order->sum('qt',$_POST));
    ?>
<option value="<?= $session[$i] ?>"><?= $session[$i] ?> 剩餘座位<?= $qt ?></option>
<?php
    }
}