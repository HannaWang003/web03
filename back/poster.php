<style>
#poster {
    height: 250px;
    overflow: auto;
}

#add table,
#poster table {
    width: 90%;
    margin: auto;
}

#poster td {
    text-align: center;
    border-bottom: 1px solid #fff;
}

#poster td>img {
    width: 40%;
}

#poster th {
    background: #999;
}

#add>h3 {
    padding: 5px;
}

#add>form {
    padding: 5px;
}
</style>
<form action="./api/edit_poster.php" method="post">
    <div id="poster" class="rb">
        <h3 class="ct wx">預告片清單</h3>
        <table>
            <tr>
                <th>預告片海報</th>
                <th>預告片片名</th>
                <th>預告片排序</th>
                <th>操作</th>
            </tr>
            <?php
            $total = $Poster->count();
            $rows = $Poster->all("order by rank");
            foreach ($rows as $idx => $row) {
            ?>
            <tr>
                <td><img src="./img/<?= $row['img'] ?>" alt=""></td>
                <td><input type="text" name="name[]" value="<?= $row['name'] ?>"></td>
                <td>
                    <input type="button" class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx > 0) ? $rows[$idx - 1]['id'] : $row['id'] ?>" value="往上">
                    <input type="button" class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx < $total - 1) ? $rows[$idx + 1]['id'] : $row['id'] ?>" value="往下">
                    <select name="ani[]" id="">
                        <option value="1" <?= ($row['ani'] == 1) ? "selected" : "" ?>>淡入淡出</option>
                        <option value="2" <?= ($row['ani'] == 2) ? "selected" : "" ?>>滑入滑出</option>
                        <option value="3" <?= ($row['ani'] == 3) ? "selected" : "" ?>>縮放(小到大)</option>
                    </select>
                </td>
                <td>
                    <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                    <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>"
                        <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示
                    <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">刪除
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="ct"><input type="submit" value="編輯確定"><input type="reset" value="重置"></div>
</form>
<div id="add" class="rb">
    <h3 class=" ct wx">新增預告片清單</h3>
    <form action="./api/add_poster.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>預告片海報：<input type="file" name="img" id="img"></td>
                <td>預告片片名：<input type="text" name="name" id="name"></td>
            </tr>
        </table>
        <div class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></div>
    </form>
</div>
<script>
$('.sw').on('click', function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    $.get('./api/sw.php', {
        table: "poster",
        id,
        sw
    }, () => {
        location.reload();
    })
})
</script>