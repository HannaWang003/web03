<?php
include_once "db.php";
echo $Order->sum('qt', ['movie' => "院線片3", 'date' => "2024-09-06", 'session' => "20:00~22:00"]);