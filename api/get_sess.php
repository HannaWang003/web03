<?php
include_once "db.php";
$H = date("G");
$start = ($H >= 14 && $_GET['date'] == date("Y-m-d")) ? 5 - ceil((24 - $H) / 2) + 1 : 0;
if ($H >= 22 && $_GET['date'] == date("Y-m-d")) {
?>
    <option value="">本日已無可供訂購場次</option>
    <?php
} else {
    for ($i = $start; $i < 5; $i++) {
        $qt = $Order->sum('qt', ['movie' => $_GET['movie'], 'date' => $_GET['date'], 'session' => $sess[$i]]);
        $lav = 20 - $qt;
    ?>
        <option value="<?= $sess[$i] ?>"><?= $sess[$i] ?> 剩餘座位 <?= $lav ?></option>
<?php
    }
}
?>