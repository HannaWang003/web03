<?php
include_once "db.php";
$H = date("G") + 1;
$today = date("Y-m-d");
if ($_POST['date'] == $today && $H > 14) {
    if ($H > 22) {
        echo "<option value='0'>今日已無可供訂購場次</option>";
    } else {
        $start = 5 - floor((24 - $H) / 2);
    }
} else {
$start=0;
}
for ($i = $start; $i < 5; $i++) {
    $_POST['session'] = $sess[$i];
    $qt = 20 - $Order->sum('qt', $_POST);
?>
<option value="<?= $sess[$i] ?>"><?= $sess[$i] ?> 剩餘座位<?= $qt ?></option>
<?php
}
?>