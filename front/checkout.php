<style>
#order {
    border: 2px solid #000;
    padding: 10px;
}

#order td:nth-child(1) {
    width: 10%;
    background: #999;
}

#order td:nth-child(2) select {
    width: 90%;
}

#order td {
    border: 1px solid #000;
    padding: 5px;
}
</style>
<?php
$row = $Order->find(['no' => $_GET['no']]);
?>
<table id="order" style="width:50%;margin:auto;">
    <tr>
        <td colspan="2">感謝您的訂購，你的訂單編號是:<?= $_GET['no'] ?></td>
    </tr>
    <tr>
        <td>電影:</td>
        <td>
            <?= $row['name'] ?>
        </td>
    </tr>
    <tr>
        <td>日期:</td>
        <td>
            <?= $row['date'] ?>
        </td>
    </tr>
    <tr>
        <td>場次:</td>
        <td>
            <?= $row['session'] ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="background:#fff;">
            座位:<br>
            <?php
            $seats = unserialize($row['seat']);
            foreach ($seats as $seat) {
                $col = ceil($seat / 5);
                $num = ($seat - 1) % 5 + 1;
                echo "{$col}排{$num}號<br>";
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;">
            <!-- <input type="submit" value="確定"> -->
            <input type="button" value="確認" onclick="location.href='index.php'">
        </td>
    </tr>
</table>