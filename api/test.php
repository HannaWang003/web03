<?php
include_once "db.php";
$test = [
    "no" => "202407170001",
    "movie" => "院線片02",
    "date" => "2024-07-18",
    "session" => "20:00~22:00",
    "qt" => "2",
    "seat" => serialize([17, 18, 19, 20]),
    "orderdate" => "2024-07-17",
];
$Order->save($test);
