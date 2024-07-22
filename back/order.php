<?php
$rows = $Order->all("order by orderdate desc");
$movies = $Order->all("group by movie");
?>
<h2 class="ct wx">訂單清單</h2>
<form action="./api/del_ord.php" method="post">
    <div>
        快速刪除：<input type="radio" name="type" value="date">依日期<input type="date" name="date" id="date">
        <input type="radio" name="type" value="movie">依電影
        <select name="movie" id="movie">
            <?php
            foreach ($movies as $m) {
                echo "<option value='{$m['movie']}'>{$m['movie']}</option>";
            }
            ?>
        </select>
        <button>刪除</button>
    </div>
</form>
<style>
#ord {
    width: 90%;
    margin: auto;
    border: 1px solid #999;
    padding: 10px;
    box-sizing: border-box;
}
</style>
<table id="ord">
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
                    echo "<div>{$col}排{$num}號</div>";
                }
                ?>
        </td>
        <td><button onclick="del(this,<?= $row['id'] ?>,'order')">刪除</button></td>
    </tr>
    <?php
    }
    ?>
</table>
<script>
function del(dom, id, table) {
    $.post('./api/del.php', {
        id,
        table
    }, () => {
        $(dom).parents('tr').remove();
    })
}
</script>