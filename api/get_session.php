<?php
include_once "db.php";
$H = date("G") + 1;
$today = date("Y-m-d");
if ($_POST['date'] == $today && $H > 22) {
?>
    <option value="0">本日已無可供訂購場次</option>
    <?php
} else {
    $start = ($_POST['date'] == $today && $H > 14) ? 5 - floor((24 - $H) / 2) : 0;
    for ($i = $start; $i < 5; $i++) {
        $_POST['session'] = $session[$i];
        $qt = 20 - $DB->sum('qt', $_POST);
    ?>
        <option value="<?= $session[$i] ?>"><?= $session[$i] ?> 剩餘座位<?= $qt ?></option>
<?php
    }
}
