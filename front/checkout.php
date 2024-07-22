<?php
$row = $Order->find(['no' => $_GET['no']]);
$seats = unserialize($row['seat']);
?>
<style>
    #ord {
        width: 80%;
        margin: auto;
        border: 1px solid #999;
        font-size: 20px;
        padding: 10px;

        td {
            border: 1px solid #333;
        }
    }
</style>
<table id="ord">
    <tr>
        <td colspan="2" class="rb">
            <h3>感謝您的訂購，您的訂單編號是：<?= $_GET['no'] ?></h3>
        </td>
    </tr>
    <tr>
        <td class="rb">電影名稱：</td>
        <td><?= $row['movie'] ?></td>
    </tr>
    <tr>
        <td class="rb">日期：</td>
        <td><?= $row['date'] ?></td>
    </tr>
    <tr>
        <td class="rb">場次時間：</td>
        <td><?= $row['session'] ?></td>
    </tr>
    <tr>
        <td colspan="2">
            座位：<br>
            <?php
            foreach ($seats as $seat) {
                $col = ceil($seat / 5);
                $num = ($seat - 1) % 5 + 1;
                echo "<div>{$col}排{$num}號</div>";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" class="rb ct"><button onclick="location.href='index.php'">確認</button></td>
    </tr>
</table>