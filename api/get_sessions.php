<?php
include_once "db.php";
$movieName = $Movie->find($_POST['movie'])['name'];
$date = $_POST['date'];
$H = date("G");
$start = ($H >= 14 && $date == date("Y-m-d")) ? 7 - ceil((24 - $H) / 2) : 1;
for ($i = $start; $i <= 5; $i++) {
    $total = $Order->sum('qt', ['movie' => $movieName, 'date' => $date, 'session' => $sess[$i]]);
    $lave = 20 - $total;
?>
    <option value="<?= $sess[$i] ?>"><?= $sess[$i] ?> 剩餘<?= $lave ?>位</option>
<?php
}
?>