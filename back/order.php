<table style="width:80%;margin:auto;background:#eee">
    <tr>
        <th colspan="7" class="wx">
            <h2>訂單清單</h2>
        </th>
    </tr>
    <tr>
        <th colspan="7">
            <form action="./api/del_order.php?do=order" method="post">
                快速刪除 :
                <input type="radio" name="type" value="date" checked>依日期<input type="date" name="date" id="date">
                <input type="radio" name="type" value="movie">依電影
                <select name="movie" id="movie">
                    <?php
                    $orders = $Order->all();
                    foreach ($orders as $ord) {
                    ?>
                    <option value="<?= $ord['movie'] ?>"><?= $ord['movie'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <input type="submit" value="刪除">
            </form>
        </th>
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
    foreach ($orders as $ord) {
        $seats = unserialize($ord['seats']);
    ?>
    <tr>
        <td class="ct" style="border-bottom:1px solid #aaa;"><?= $ord['no'] ?></td>
        <td class="ct" style="border-bottom:1px solid #aaa;"><?= $ord['movie'] ?></td>
        <td class="ct" style="border-bottom:1px solid #aaa;"><?= $ord['date'] ?></td>
        <td class="ct" style="border-bottom:1px solid #aaa;"><?= $ord['session'] ?></td>
        <td class="ct" style="border-bottom:1px solid #aaa;"><?= $ord['qt'] ?></td>
        <td class="ct" style="border-bottom:1px solid #aaa;">
            <?php
                foreach ($seats as $seat) {
                    $col = ceil($seat / 5);
                    $num = ($seat - 1) % 5 + 1;
                    echo "<div>{$col}排{$num}號</div>";
                }
                ?>
        </td>
        <td class="ct" style="border-bottom:1px solid #aaa;"><button onclick="del(<?= $ord['id'] ?>)">刪除</button>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<script>
function del(id) {
    $.post('./api/del_order.php?do=order', {
        id
    }, () => {
        location.reload();
    })
}
</script>