<?php
$rows = $Movie->all("order by rank");
?>
<button onclick="location.href='?do=add_movie'">新增電影</button>