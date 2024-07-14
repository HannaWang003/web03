<?php
include_once "db.php";
$Order->save([
    'no' => '202407130001',
    'name' => '院線片2',
    'date' => '2024-07-13',
    'session' => '20:00~22:00',
    'seat' => serialize(["19", "20"]),
    'qt' => '3'
]);
