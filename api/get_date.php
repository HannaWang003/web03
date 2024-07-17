<?php
include_once "db.php";
$row = $Movie->find(['name' => $_GET['movie']]);
$today = strtotime(date("Y-m-d"));
$end = strtotime("+2 days", strtotime($row['ondate']));
$diff = ($end - $today) / (60 * 60 * 24);
for ($i = 0; $i <= $diff; $i++) {
    $date = date("Y-m-d", strtotime("+$i days"));
?>
    <option value="<?= $date ?>"><?= $date ?></option>
<?php
}

?>