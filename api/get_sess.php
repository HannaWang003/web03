<?php
include_once "db.php";
$H = date("G");
if ($_GET['date'] == date("Y-m-d") && $H >= 14) {
    $start = 5 - ceil((24 - $H) / 2) + 1;
} else {
    $start = 0;
}
for ($i = $start; $i < 5; $i++) {
    $qt = 20 - ($Order->sum('qt', ['movie' => $_GET['movie'], 'date' => $_GET['date'], 'session' => $sess[$i]]));
    echo "<option value='{$sess[$i]}'>{$sess[$i]} 剩餘 $qt 位</option>";
}
