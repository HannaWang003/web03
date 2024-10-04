<h3 class="wx ct" style="padding:10px;">訂單清單</h3>
<table width="100%">
    <tr>
        <td colspan="7">
            <form action="./api/del_ord.php?do=order" method="post">
                快速刪除: <input type="radio" name="type" value="date" checked><input type="date" name="date" id="">依日期
                <input type="radio" name="type" value="movie"><select name="movie" id="">
                    <?php
                    $rows = $DB->all();
                    foreach ($rows as $row) {
                    ?>
                        <option value="<?= $row['movie'] ?>"><?= $row['movie'] ?></option>
                    <?php
                    }
                    ?>
                </select>依電影
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
    foreach ($rows as $row) {
    ?>
        <tr>
            <td style="border-bottom:1px solid #eee;padding:10px;"><?= $row['no'] ?></td>
            <td style="border-bottom:1px solid #eee;padding:10px;"><?= $row['movie'] ?></td>
            <td style="border-bottom:1px solid #eee;padding:10px;"><?= $row['date'] ?></td>
            <td style="border-bottom:1px solid #eee;padding:10px;"><?= $row['session'] ?></td>
            <td style="border-bottom:1px solid #eee;padding:10px;"><?= $row['qt'] ?></td>
            <td style="border-bottom:1px solid #eee;padding:10px;">
                <?php
                $seats = unserialize($row['seats']);
                foreach ($seats as $s) {
                    $col = ceil($s / 5);
                    $num = ($s - 1) % 5 + 1;
                }
                ?>
                <div><?= $col ?>排<?= $num ?>號</div>
            </td>
            <td style="border-bottom:1px solid #eee;padding:10px;"><button onclick="del(<?= $row['id'] ?>)">刪除</button>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<script>
    function del(id) {
        $.post('./api/del.php?do=<?= $table ?>', {
            id
        }, () => {
            location.reload();
        })
    }
</script>