<?php
$row = $Order->find(['no' => $_GET['no']]);
?>
<style>
#info {
    width: 60%;
    background: #333;
    box-shadow: 5px 5px 2px #999;
    border: 1px solid #333;
    border-radius: 5px;
    box-sizing: border-box;
    margin: auto;
    color: #eee;

    table {
        background: #999;
        width: 90%;
        border: 1px solid #fff;
        padding: 20px 10px;
        margin: 20px auto;

        td:nth-child(1) {
            border: 1px solid #fff;
        }

        td:nth-child(2) {
            background: #fff;
            color: #333;
        }
    }
}
</style>
<div id="info">
    <table>
        <tr>
            <td class="rb" colspan="2">感謝您的訂購，您的訂單編號是 : <?= $row['no'] ?></td>
        </tr>
        <tr>
            <td class="rb">電影名稱 : </td>
            <td><?= $row['movie'] ?></td>
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
            <td colspan="2">座位 :
                <?php
                $seats = unserialize($row['seat']);
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
            <td class="rb ct" colspan="2"><input type="button" value="確認" onclick="location.href='index.php'"></td>
        </tr>
    </table>
</div>