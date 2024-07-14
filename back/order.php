<div class="ct rb" style="padding:5px;"><b>訂單清單</b></div>
<form action="./api/del_order.php" method="post">
    <div>快速刪除:
        <input type="radio" name="type" value="date" checked>依日期<input type="date" name="date" id="date">
        <input type="radio" name="type" value="movie">依電影
        <select name="name" id="name">
            <?php
            $rows = $Order->all("group by `name`");
            foreach ($rows as $row) {
                echo "<option value='{$row['name']}'>{$row['name']}</option>";
            }
            ?>
        </select>
        <button>刪除</button>
    </div>
</form>
<div style="height:250px;overflow:auto;">
    <table style="width:95%;margin:auto;">
        <tr>
            <th>訂單編號</th>
            <th>電影名稱</th>
            <th>日期</th>
            <th>場次時間</th>
            <th>訂購數量</th>
            <th>訂購位置</th>
            <th>操作</th>
        </tr>
        <style>
            table {
                border-collapse: collapse;
            }

            tr {
                border-bottom: 1px solid #333;

            }

            td {
                padding: 10px;
            }
        </style>
        <?php
        $rows = $Order->all("order by no desc");
        if (!empty($rows)) {
            foreach ($rows as $idx => $row) {
        ?>
                <tr style="background:#999;">
                    <td style="text-align:center"><?= $row['no'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td style="text-align:center"><?= $row['date'] ?></td>
                    <td style="text-align:center"><?= $row['session'] ?></td>
                    <td style="text-align:center"><?= $row['qt'] ?></td>
                    <td style="text-align:center">
                        <?php
                        $seats = unserialize($row['seat']);
                        foreach ($seats as $s) {
                            $col = ceil($s / 5);
                            $num = ($s - 1) % 5 + 1;
                            echo "<div>{$col}排{$num}號</div>";
                        }
                        ?>
                    </td>
                    <td style="text-align:center">
                        <input type="button" value="刪除" onclick="del('order',<?= $row['id'] ?>)">
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
</div>
<script>
    function del(table, id) {
        $.get('./api/del.php', {
            table,
            id
        }, () => {
            location.reload();
        })
    }
</script>