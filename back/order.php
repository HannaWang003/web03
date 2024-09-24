<h2 class="ct wx">訂單清單</h2>
<table class="ts">
    <tr>
        <td colspan="7" class="wx" style="padding:10px;">
            <form action="./api/del.php?do=order" method="post">
                快速刪除 : <input type="radio" name="type" value="date" checked>依日期<input type="date" name="date" id="">
                <input type="radio" name="type" value="movie">依電影
                <select name="movie" id="">
                    <?php
                    $movies = $Order->all();
                    foreach ($movies as $m) {
                    ?>
                    <option value="<?= $m['movie'] ?>"><?= $m['movie'] ?></option>
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
        <th class="rb">訂單數量</th>
        <th class="rb">訂購位置</th>
        <th class="rb">操作</th>
    </tr>
    <?php
    foreach ($movies as $m) {
    ?>
    <tr>
        <td style="border-bottom:1px solid #fff;"><?= $m['no'] ?></td>
        <td style="border-bottom:1px solid #fff;"><?= $m['movie'] ?></td>
        <td style="border-bottom:1px solid #fff;"><?= $m['date'] ?></td>
        <td style="border-bottom:1px solid #fff;"><?= $m['session'] ?></td>
        <td style="border-bottom:1px solid #fff;"><?= $m['qt'] ?></td>
        <td style="border-bottom:1px solid #fff;"><?php
                                                        $seats = unserialize($m['seats']);
                                                        foreach ($seats as $s) {
                                                            $col = ceil($s / 5);
                                                            $num = ($s - 1) % 5 + 1;
                                                        ?>
            <div><?= $col ?>排<?= $num ?>號</div>
            <?php
                                                        }
                ?>
        </td>
        <td style="border-bottom:1px solid #fff;"><button onclick="del(<?= $m['id'] ?>)">刪除</button></td>
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