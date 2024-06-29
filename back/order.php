<?php
$ords = $Order->all("order by no");
?>
<style>
    table {
        width: 100%;
        table-layout: fixed;
    }

    td {
        text-align: center;
    }
</style>
<div class="ct mytitle">訂單清單</div>
<div>
    <form action="./api/del_order.php" method="post">
        <span>快速刪除: </span>
        <input type="radio" name="type" checked>依日期
        <input type="text" name="" id="">
        依電影<select name="" id="">

        </select>
        <input type="submit" value="刪除">
    </form>
</div>
<div>
    <table>
        <tr>
            <th>訂單編號</th>
            <th>電影名稱</th>
            <th>日期</th>
            <th>場次時間</th>
            <th>訂購數量</th>
            <th>訂購位置</th>
            <th>操作</th>
        </tr>
        <?php
        foreach ($ords as $ord) {
            $seats = unserialize($ord['seats']);
        ?>
            <tr>
                <td><?= $ord['no'] ?></td>
                <td><?= $ord['movie'] ?></td>
                <td><?= $ord['date'] ?></td>
                <td><?= $ord['session'] ?></td>
                <td><?= $ord['qt'] ?></td>
                <td><?php
                    foreach ($seats as $seat) {
                        $col = ceil($seat / 5);
                        $num = ($seat - 1) * 5 - 1;
                    ?>
                        <div><?= $col . "排" . $num . "號" ?></div>
                    <?php
                    }
                    ?>
                </td>
                <td><input type="button" value="刪除" onclick="del(<?= $ord['id'] ?>,'order')"></td>
            </tr>

        <?php
        }
        ?>
    </table>
</div>
<script>
    function del(id, table) {
        $.post('./api/del.php', {
            id,
            table
        }, () => {
            location.reload();
        })
    }
</script>