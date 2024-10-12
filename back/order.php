<style>
table,
tr,
td {
    border-collapse: collapse;
}

td {
    background: #eee;
    color: #333;
    border-bottom: 1px solid #333;
}
</style>
<h3 class="ct wx">訂單清單</h3>
<table width="100%">
    <tr>
        <td colspan="7">
            <form action="./api/del.php?do=order" method="post">
                快速刪除 : <input type="radio" name="type" value="date" checked>依日期<input type="date" name="date" id="date">
                <input type="radio" name="type" value="movie">依電影<select name="movie" id="movie">
                    <?php
                    $ords = $DB->all("group by `movie`");
                    foreach ($ords as $ord) {
                    ?>
                    <option value="<?= $ord['movie'] ?>"><?= $ord['movie'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="submit" value="刪除">
            </form>
        </td>
    </tr>
    <tr>
        <th class="rb">訂單編號</th>
        <th class="rb">電影名稱</th>
        <th class="rb">日期</th>
        <th class="rb">場次時間</th>
        <th class="rb">訂購數量</th>
        <th class="rb">訂購位置</th>
        <th class="rb">操作</th>
    </tr>
    <?php
    $rows = $DB->all();
    foreach ($rows as $row) {
    ?>
    <tr>
        <td class="ct"><?= $row['no'] ?></td>
        <td class="ct"><?= $row['movie'] ?></td>
        <td class="ct"><?= $row['date'] ?></td>
        <td class="ct"><?= $row['session'] ?></td>
        <td class="ct"><?= $row['qt'] ?></td>
        <td class="ct"><?php
                            $seats = unserialize($row['seat']);
                            foreach ($seats as $i) {
                                $col = ceil($i / 5);
                                $num = ($i - 1) % 5 + 1;
                            ?>
            <div><?= $col ?>排<?= $num ?>號</div>
            <?php
                            }
                ?>
        </td>
        <td class="ct"><input type="button" value="刪除" onclick="del(<?= $row['id'] ?>)"></td>
    </tr>
    <?php
    }
    ?>
</table>
<script>
function del(id) {
    $.post('./api/del.php?do=order', {
        id
    }, () => {
        location.reload();
    })
}
</script>