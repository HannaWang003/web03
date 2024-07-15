<?php
include_once "db.php";
$Order->save([
    'no' => '202407150001',
    'name' => '院線片08',
    'date' => '2024-07-15',
    'session' => '14:00~16:00',
    'seat' => serialize(["1", "2", "3"]),
    'qt' => '3'
]);
