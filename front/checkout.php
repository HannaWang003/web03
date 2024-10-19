<?php
$row = $Order->find(['no' => $_GET['no']]);
?>
<table width="60%;" style="margin:auto;border:1px solid #999;box-shadow:0 0 10px #fff;padding:10px;">
    <tr class="c w">
        <td class="rb" colspan="2">
            <h2>感謝您的訂購，您的訂單編號是 : <?= $_GET['no'] ?></h2>
        </td>
    </tr>
    <tr class="c w">
        <td class="rb">電影名稱 : </td>
        <td><?= $row['name'] ?></td>
    </tr>
    <tr class="c w">
        <td class="rb">日期 : </td>
        <td><?= $row['date'] ?></td>
    </tr>
    <tr class="c w">
        <td class="rb">場次 : </td>
        <td><?= $row['session'] ?></td>
    </tr>
    <tr class="c w">
        <td colspan="2">
            座位 :
            <?php
            $seats = unserialize($row['seats']);
            foreach ($seats as $s) {
                $col = ceil($s / 5);
                $num = ($s - 1) % 5 + 1;
            ?>
                <div><?= $col . "排" . $num . "號" ?></div>
            <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="ct rb"><input type="button" value="返回" onclick="location.href='index.php'"></td>
    </tr>
</table>