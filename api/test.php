<?php
include_once "db.php";
$test = [
    'no' => 2024,
    'movie' => 'text',
    'date' => '2024-03-06',
    'session' => '14:00~16:00',
    'qt' => 4
];
$test['seat'] = serialize(["1", "2", "3", "4"]);
$Order->save($test);
