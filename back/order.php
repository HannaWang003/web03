<style>
    #poster {
        overflow: auto;
    }

    #poster table {
        width: 90%;
        margin: auto;
    }

    #poster td {
        text-align: center;
        border-bottom: 1px solid #fff;
    }

    #poster th {
        background: #999;
    }
</style>
<div id="poster" class="rb">
    <h3 class="ct wx">訂單清單</h3>
    <div>
        <form action="./api/del_ord.php" method="post">
            <span>快速刪除：</span>
            <input type="radio" name="type" value="date" checked>依日期<input type="date" name="date" id="date">
            <input type="radio" name="type" value="movie">依電影
            <select name="movie" id="movie">
                <?php
                $ords = $Order->all("group by movie");
                foreach ($ords as $ord) {
                ?>
                    <option value="<?= $ord['movie'] ?>"><?= $ord['movie'] ?></option>
                <?php
                }
                ?>
            </select>
            <button class="del">刪除</button>
        </form>
    </div>
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
        $rows = $Order->all("order by no");
        foreach ($rows as $idx => $row) {
            $seats = unserialize($row['seat']);
        ?>
            <tr>
                <td><?= $row['no'] ?></td>
                <td><?= $row['movie'] ?></td>
                <td><?= $row['date'] ?></td>
                <td><?= $row['session'] ?></td>
                <td><?= $row['qt'] ?></td>
                <td>
                    <?php
                    foreach ($seats as $seat) {
                        $col = ceil($seat / 5);
                        $num = ($seat - 1) % 5 + 1;
                        echo "$col 排 $num 號<br>";
                    }
                    ?>
                </td>
                <td>
                    <button onclick="del('order',<?= $row['id'] ?>)">刪除</button>
                </td>
            </tr>
        <?php
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