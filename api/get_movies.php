<?php
include_once "db.php";
$today = date("Y-m-d");
$ondate = date("Y-m-d", strtotime("-2 days"));
$movies = $Movie->all(" where `sh`=1 && `ondate` between '$ondate' and '$today' ", "order by rank");
foreach ($movies as $movie) {
?>
    <option value="<?= $movie['id'] ?>"><?= $movie['name'] ?></option>
<?php
}
