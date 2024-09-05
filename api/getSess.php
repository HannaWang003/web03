<?php
include_once "db.php";
$H = date("G");
$date = $_GET['date'];
$today = date("Y-m-d");
if ($H >= 14 && ($date == $today)) {
    if ($H < 22) {
        $start = 5 - floor((24 - $H) / 2);
        for ($i = $start; $i < 5; $i++) {
?> <option value="<?= $sess[$i] ?>"><?= $sess[$i] ?></option>;
        <?php
        }
    } else {
        ?>
        <option value="0">今日已無可供訂購場次</option>
    <?php
    }
} else {
    for ($i = 0; $i < 5; $i++) {
    ?>
        <option value="<?= $sess[$i] ?>"><?= $sess[$i] ?></option>
<?php
    }
}
