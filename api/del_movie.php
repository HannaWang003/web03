<?php
include_once "db.php";
$DB->del($_GET['id']);
to("../back.php?do=$table");
