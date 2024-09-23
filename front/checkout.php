<?php
$row = $Order->find(['no' => $_GET['no']]);
?>
<style>
table,
tr,
td {
    border: 1px solid #aaa;
    padding: 10px 5px;
}
</style>
<table style="width:60%;margin:auto;">
    <tr>
        <td colspan=2 class="rb">感謝您的訂購，您的訂單編號是 : <?= $_GET['no'] ?></td>
    </tr>
    <tr>
        <td class="rb" style="width:30%">電影名稱 : </td>
        <td style="width:70%"><?= $row['movie'] ?></td>
    </tr>
    <tr>
        <td class="rb">日期 : </td>
        <td><?= $row['date'] ?></td>
    </tr>
    <tr>
        <td class="rb">場次時間 : </td>
        <td><?= $row['session'] ?></td>
    </tr>
    <tr>
        <td colspan="2">
            座位:
            <?php
            $row['seats'] = unserialize($row['seats']);
            foreach ($row['seats'] as $seat) {
                $col = ceil($seat / 5);
                $num = ($seat - 1) % 5 + 1
            ?>
            <div><?= $col ?>排<?= $num ?>號</div>
            <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="ct rb"><button onclick="location.href='index.php'">確認</button></td>
    </tr>
</table>