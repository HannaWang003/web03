<h3 class="rb ct" style="margin:auto;padding:10px">訂單管理</h3>
<div>
    <form action="./api/del_movie.php" method="post">
        快速刪除<input type="radio" name="type" value="date" checked>依日期<input type="date" name="date">
        <input type="radio" name="type" value="movie">依電影<select name="movie">
            <?php
            $movies = $Order->all("group by movie");
            foreach ($movies as $movie) {
            ?>
            <option value="<?= $movie['movie'] ?>"><?= $movie['movie'] ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="刪除">
    </form>
</div>
<style>
th,
td {
    padding: 5px 10px
}
</style>
<table style="margin:auto">
    <tr class="rb">
        <th>訂單編號</th>
        <th>電影名稱</th>
        <th>日期</th>
        <th>場次時間</th>
        <th>訂購數量</th>
        <th>訂購位置</th>
        <th>操作</th>
    </tr>
    <?php
    $rows = $Order->all();
    foreach ($rows as $row) {
        $seats = unserialize($row['seats']);
    ?>
    <tr class="rb">
        <td><?= $row['no'] ?></td>
        <td><?= $row['movie'] ?></td>
        <td><?= $row['date'] ?></td>
        <td><?= $row['session'] ?></td>
        <td><?= $row['qt'] ?></td>
        <td><?php
                foreach ($seats as $seat) {
                    $col = floor($seat / 5) + 1;
                    $val = ($seat - 1) % 5 + 1;
                ?>
            <div><?= $col . "排" . $val . "號" ?></div>
            <?php
                }
                ?>
        </td>
        <td><button onclick="location.href='./api/del_movie.php?id=<?= $row['id'] ?>'">刪除</button></td>
    </tr>
    <?php
    }
    ?>
</table>