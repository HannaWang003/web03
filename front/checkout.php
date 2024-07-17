<style>
#order table {
    width: 60%;
    margin: auto;
    border: 1px solid #000;
    padding: 10px;
}

#order td:nth-child(odd) {
    background: #eee;
}

#order td:nth-child(even) {
    border: 1px solid #000;
}

#order td {
    padding: 10px;
}
</style>
<?php
$row = $Order->find(['no' => $_GET['no']]);
?>
<div id="order">
    <table>
        <tr>
            <td colspan="2">
                <h3>感謝您的訂購，您的訂單編號是：<?= $row['no'] ?></h3>
            </td>
        </tr>
        <tr>
            <td style="width:40%;">電影名稱 : </td>
            <td style="width:60%;">
                <?= $row['movie'] ?>
            </td>
        </tr>
        <tr>
            <td style="width:40%;">日期 : </td>
            <td style="width:60%;">
                <?= $row['date'] ?>
            </td>
        </tr>
        <tr>
            <td style="width:40%;">場次時間 : </td>
            <td style="width:60%;">
                <?= $row['session'] ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="background:#fff;border:1px solid #000">
                座位：<br>
                <?php
                    $seats = unserialize($row['seat']);
                    foreach ($seats as $seat) {
                        $col = ceil($seat / 5);
                        $num = ($seat - 1) % 5 + 1;
                        echo "$col 排 $num 號<br>";
                    }
                    ?>

            </td>
        </tr>
        <tr>
            <td colspan="2" class="ct"><button onclick="location.href='index.php'">確認</button></td>
        </tr>
    </table>
</div>