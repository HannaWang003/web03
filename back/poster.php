<?php
$rows = $Poster->all("order by rank");
?>
<h3 class="ct mytitle">預告片清單</h3>
<style>
table {
    width: 95%;
    margin: auto;
    text-align: center;
}

table,
tr,
td {
    border-collapse: collapse;
}

th {
    background: #aaa;
    color: #000;
}

td {
    color: #000;
    border-bottom: 1px solid #000;
    padding: 10px 0;
}
</style>
<form action="./api/edit_poster.php" method="post">
    <div style="height:250px;overflow-y:scroll;background:#eee;padding:10px;">
        <table>
            <tr>
                <th style="width:24.5%">預告片海報</th>
                <th style="width:24.5%">預告片片名</th>
                <th style="width:24.5%">預告片排序</th>
                <th style="width:24.5%">操作</th>
            </tr>
            <?php
            $max = $Poster->count() - 1;
            foreach ($rows as $idx => $row) {
            ?>
            <tr>
                <td><img src="./img/<?= $row['img'] ?>" style="width:60px;height:80px;"></td>
                <td><input type="text" name="name[]" value="<?= $row['name'] ?>"></td>
                <td>
                    <input class="chg-btn" type="button" value="往上" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx != 0) ? $rows[$idx - 1]['id'] : $row['id'] ?>"> <input class="chg-btn"
                        type="button" value="往下" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx != $max) ? $rows[$idx + 1]['id'] : $row['id'] ?>">
                </td>
                <td>
                    <div>
                        <select name="ani[]">
                            <option value="1" <?= ($row['ani'] == "1") ? "selected" : "" ?>>淡入淡出</option>
                            <option value="2" <?= ($row['ani'] == "2") ? "selected" : "" ?>>滑入滑出</option>
                            <option value="3" <?= ($row['ani'] == "3") ? "selected" : "" ?>>縮放</option>
                        </select>
                    </div>
                    <div>
                        <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>"
                            <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示<input type="checkbox" name="del[]"
                            value="<?= $row['id'] ?>">
                        <input type="hidden" name="id[]" value="<?= $row['id'] ?>">刪除
                    </div>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="ct">
        <input type="submit" value="修改確定"> <input type="reset" value="重置">
    </div>
</form>
<h3 class="ct mytitle">新增預告片海報</h3>
<form action="./api/add_poster.php" method="post" enctype="multipart/form-data">
    <table style="width:100%;margin:auto;">
        <tr>
            <td>
                預告片海報: <input type="file" name="img">
            </td>
            <td>
                預告片片名: <input type="text" name="name">
            </td>
        </tr>
    </table>
    <div class="ct">
        <input type="submit" value="新增"> <input type="reset" value="重置">
    </div>
</form>
<script>
$('.chg-btn').on('click', function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    let table = "poster";
    $.post('./api/sw.php', {
        id,
        sw,
        table
    }, () => {
        location.reload();
    })
})
</script>