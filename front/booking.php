<?php
include_once "./api/db.php";
$row = $Order->find(['no' => $_GET['no']]);
?>
<style>
    table,
    td {
        border: 1px solid #000;
    }
</style>
<table style="width:60%;margin:auto;border:1px solid #000;">
    <tr>
        <td colspan="2" class="rb">感謝您的訂購，您的訂單編號是:<?= $row['no'] ?></td>
    </tr>
    <tr>
        <td class="rb">電影名稱:</td>
        <td><?= $row['movie'] ?></td>
    </tr>
    <tr>
        <td class="rb">日期:</td>
        <td><?= $row['date'] ?></td>
    </tr>
    <tr>
        <td class="rb">場次時間:</td>
        <td><?= $row['session'] ?></td>
    </tr>
    <tr>
        <td colspan="2">
            <?php
            $seats = unserialize($row['seat']);
            foreach ($seats as $seat) {
                $col = floor(($seat - 1) / 5) + 1;
                $num = ($seat - 1) % 5 + 1;
            ?>
                <div><?= $col . "排" . $num . "號" ?></div>
            <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="ct rb"><button onclick="location.href='index.php'">確認</button></td>
    </tr>
</table>