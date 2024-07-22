<?php
include_once "db.php";
$H = date("G");
$today = date("Y-m-d");
$date = $_GET['date'];
if ($H >= 22 && $date == $today) {
    echo "<option value='0'>本日已無可供訂購的場次，請改選其他日期</option>";
} else {
    $start = ($H >= 14 && $date == $today) ? 5 - ceil((24 - $H) / 2) + 1 : 0;
    for ($i = $start; $i < 5; $i++) {
        $qt = 20 - $Order->sum('qt', ['movie' => $_GET['movie'], 'date' => $date, 'session' => $sess[$i]]);
?>
        <option value="<?= $sess[$i] ?>"><?= $sess[$i] ?> 剩餘座位 <?= $qt ?></option>
<?php

    }
}
?>