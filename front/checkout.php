<style>
    table {
        width: 100%;
    }

    table,
    tr,
    td {
        border-collapse: collapse;
    }

    td {
        border: 1px solid #000;
    }

    td:nth-child(1) {
        width: 35%;
    }

    td:nth-child(2) {
        width: 65%;
    }
</style>
<h2 class="ct">感謝您的訂購，您的訂單編號是:<?= $_GET['no'] ?></h2>
<div style="width:50%;margin:auto">
    <?php
    $row = $Order->find(['no' => $_GET['no']]);
    $seats = unserialize($row['seats']);
    ?>
    <table>
        <tr>
            <td>電影名稱: </td>
            <td><?= $row['movie'] ?></td>
        </tr>
        <tr>
            <td>日期: </td>
            <td><?= $row['date'] ?></td>
        </tr>
        <tr>
            <td>場次時間: </td>
            <td><?= $row['session'] ?></td>
        </tr>
    </table>
    <div style="border:2px solid #000;box-sizing:border-box;">
        <?php
        foreach ($seats as $seat) {
            $col = ceil($seat / 5);
            $num = ($seat - 1) % 5 + 1;
        ?>
            <div><?= $col . "排" . $num . "號" ?></div>
        <?php
        }
        ?>
    </div>
    <br>
    <div class="ct"><button onclick="location.href='index.php'">確認</button></div>
</div>