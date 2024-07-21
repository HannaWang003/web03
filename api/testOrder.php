<?php
include_once "db.php";
$no = $Order->max('id') + 1;
$test['no'] = date("Ymd") . sprintf("%04d", $no);
$test['movie'] = "院線片02";
$test['date'] = "2024-07-22";
$test['session'] = "14:00~16:00";
$test['qt'] = "4";
$test['seat'] = serialize([5, 6, 7, 8]);
$test['orderdate'] = "2024-07-21";
$Order->save($test);
to("../back.php?do=order");
