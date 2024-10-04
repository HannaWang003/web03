<h3 class="wx ct">預告片清單</h3>
<form action="./api/edit_poster.php?do=<?= $table ?>" method="post">
    <div style="height:250px;overflow:auto;">
        <table width="100%;">
            <tr>
                <th class="rb">預告片海報</th>
                <th class="rb">預告片片名</th>
                <th class="rb">預告片排序</th>
                <th class="rb">操作</th>
            </tr>
            <?php
            $rows = $DB->all("order by rank");
            $end = $DB->count() - 1;
            foreach ($rows as $idx => $row) {
            ?>
            <tr>
                <th style="border-bottom:1px solid #eee"><img src="./img/<?= $row['img'] ?>" style="width:100px"></th>
                <th style="border-bottom:1px solid #eee"><input type="text" name="text[]" value="<?= $row['text'] ?>">
                </th>
                <th style="border-bottom:1px solid #eee"><button
                        onclick="sw(<?= $row['id'] ?>,<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>)">往上</button>
                    <button
                        onclick="sw(<?= $row['id'] ?>,<?= ($idx == $end) ? $row['id'] : $rows[$idx + 1]['id'] ?>)">往下</button>
                </th>
                <th style="border-bottom:1px solid #eee">
                    <select name="ani[]" id="">
                        <option value="1" <?= ($row['ani'] == 1) ? "selected" : "" ?>>淡入淡出</option>
                        <option value="2" <?= ($row['ani'] == 2) ? "selected" : "" ?>>滑入滑出</option>
                        <option value="3" <?= ($row['ani'] == 3) ? "selected" : "" ?>>縮放</option>
                    </select>
                    <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>"
                        <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示
                    <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">刪除
                </th>
            </tr>
            <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
            <?php
            }
            ?>
        </table>
    </div>
    <div class="ct"><input type="submit" value="編輯確定"> <input type="reset" value="重置"></div>
</form>
<hr>
<h3 class="wx ct">新增預告片海報</h3>
<form action="./api/add_poster.php?do=poster" method="post" enctype="multipart/form-data">
    <table style="margin:auto">
        <tr>
            <th style="padding:2px 20px;">預告片海報</th>
            <td style="padding:2px 20px;"><input type="file" name="img" id=""></td>
            <th style="padding:2px 20px;">預告片片名</th>
            <td style="padding:2px 20px;"><input type="text" name="text" id=""></td>
        </tr>
    </table>
    <div class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></div>
</form>
<script>
function sw(id, sw) {
    $.post('./api/sw.php?do=<?= $table ?>', {
        id,
        sw
    }, () => {
        location.reload();
    })
}
</script>