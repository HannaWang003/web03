<?php
unset($_GET['do']);
$row = $Order->find($_GET);
?>
<table style="width:60%;border:1px solid #333;box-sizing:border-box;padding:20px 10px;margin:auto">
    <tr>
        <td colspan="2" class="wx">
            <h2>感謝您的訂購，您的訂單編號是:<?= $row['no'] ?></h2>
        </td class="ts">
    </tr>
    <tr>
        <td class="rb" width="30%">電影名稱:</td>
        <td width="70%" class="ra"><?= $row['movie'] ?></td>
    </tr>
    <tr>
        <td class="rb">日期:</td>
        <td class="ra"><?= $row['date'] ?></td>
    </tr>
    <tr>
        <td class="rb">場次時間:</td>
        <td class="ra"><?= $row['session'] ?></td>
    </tr>
    <tr>
        <td colspan="2" class="ra">
            座位:
            <?php
            $seats = unserialize($row['seats']);
            foreach ($seats as $s) {
                $col = ceil($s / 5);
                $num = $s - 1 % 5 + 1;
            ?>
                <div><?= $col ?>排<?= $num ?>號</div>
            <?php
            }
            ?>
    </tr>
    <tr>
        <td colspan="2" class="ct rb" style="padding:10px"><button onclick="location.href='index.php'">確認</button></td>
    </tr>
</table>