<?php
for ($i = 1; $i <= $pages; $i++) {
    $style = ($now == $i) ? "font-size:22px" : "";
?>
    <a href="?p=<?= $i ?>" style="color:#fff;<?= $style ?>"><?= $i ?></a>
<?php
}
?>