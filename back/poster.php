<style>
td {
    text-align: center;
    border-bottom: 2px solid rgba(39, 39, 39, 0.7);
    ;
    padding: 5px 10px;
}

table {
    border-collapse: collapse;
}
</style>
<form method="post" action="./api/edit_poster.php?do=poster">
    <div style="height:250px;overflow:auto">
        <h3 class="ct wx">預告片清單</h3>
        <table style="width:100%">
            <tr class="rb">
                <th>預告片海報</th>
                <th>預告片片名</th>
                <th>預告片排序</th>
                <th>操作</th>
            </tr>
            <?php
            $rows = $DB->all("order by rank");
            foreach ($rows as $idx => $row) {
            ?>
            <tr style="background:#aaa">
                <td><img src="./img/<?= $row['img'] ?>" style="width:100px;"></td>
                <td><input type="text" name="name[]" value="<?= $row['name'] ?>"></td>
                <td>
                    <input onclick="sw(this)" type="button" value="往上" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>">
                    <input onclick="sw(this)" type="button" value="往下" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == (count($rows) - 1)) ? $row['id'] : $rows[$idx + 1]['id'] ?>">
                </td>
                <td>
                    <select name="ani[]" id="">
                        <option value="1" <?= ($row['ani'] == 1) ? "selected" : "" ?>>淡入淡出</option>
                        <option value="2" <?= ($row['ani'] == 2) ? "selected" : "" ?>>滑入滑出</option>
                        <option value="3" <?= ($row['ani'] == 3) ? "selected" : "" ?>>縮放</option>
                    </select>
                    <br>
                    <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>"
                        <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示<input type="checkbox" name="del[]"
                        value="<?= $row['id'] ?>">刪除
                </td>
            </tr>
            <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
            <?php
            }
            ?>
        </table>
    </div>
    <div CLASS="ct"><input type="submit" value="編輯確定"><input type="reset" value="重置"></div>
</form>
<style>
td {
    border-bottom: 0px;
}
</style>
<form action="./api/add_poster.php?do=poster" method="post" enctype="multipart/form-data">
    <h3 class="ct wx">新增預告片海報</h3>
    <table width="100%" class="rb">
        <tr>
            <td>預告片海報:</td>
            <td><input type="file" name="img" id=""></td>
            <td>預告片片名:</td>
            <td><input type="text" name="name" id=""></td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="submit" value="新增"><input type="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
<script>
function sw(dom) {
    let id = $(dom).data('id');
    let sw = $(dom).data('sw');
    $.get('./api/sw.php?do=poster', {
        id,
        sw
    }, () => {
        location.reload();
    })
}
</script>