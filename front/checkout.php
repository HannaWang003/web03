<?php
$row = $Order->find(['no' => $_GET['no']]);
$seats = unserialize($row['seats']);
?>
<table width="80%" style="margin:auto;border:1px solid #333;">
    <tr>
        <td class="rb" colspan="2">
            <h2>感謝您的訂購，您的訂單編號是 : <?= $row['no'] ?></h2>
        </td>
    </tr>
    <tr>
        <td class="rb">電影名稱 : </td>
        <td style="border:1px solid #999;"><?= $row['movie'] ?></td>
    </tr>
    <tr>
        <td class="rb">日期 : </td>
        <td style="border:1px solid #999;"><?= $row['date'] ?></td>
    </tr>
    <tr>
        <td class="rb">場次 : </td>
        <td style="border:1px solid #999;"><?= $row['session'] ?></td>
    </tr>
    <tr>
        <td colspan="2">
            座位 :
            <?php
            foreach ($seats as $seat) {
                $col = ceil($seat / 5);
                $num = ($seat - 1) % 5 + 1;
            ?>
                <div><?= $col ?>排<?= $num ?>號</div>
            <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td class="rb ct" colspan="2" style="padding:20px;"><button onclick="location.href='index.php'">確認</button></td>
    </tr>
</table>