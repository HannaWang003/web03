<?php
include_once "db.php";
$today = date("Y-m-d");
$ondate = date("Y-m-d", strtotime("-2 days"));
$movies = $Movie->all(" where `sh` ='1' && `ondate` between '$ondate' and '$today' ");
if (!empty($movies)) {
    foreach ($movies as $movie) {
?>
        <option value="<?= $movie['name'] ?>" <?= ($movie['id'] == $_GET['id']) ? "selected" : "" ?>><?= $movie['name'] ?>
        </option>
    <?php
    }
} else {
    ?>
    <option value="目前無上映中電影">目前無上映中電影</option>
<?php
}
