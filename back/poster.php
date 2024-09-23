<?php
$rows = $DB->all("order by rank");
$num = count($rows) - 1;
?>
<form action="./api/edit_poster.php?do=poster" method="post">
    <div style="height:250px;overflow:auto;">
        <h3 class="ct wx">預告片清單</h3>
        <table style="width:90%;margin:auto;background:#666;padding:10px 5px;color:#fff;">
            <tr>
                <th class="rb">預告片海報</th>
                <th class="rb">預告片片名</th>
                <th class="rb">預告片排序</th>
                <th class="rb">操作</th>
            </tr>
            <?php
            foreach ($rows as $idx => $row) {
            ?>
            <tr>
                <td style="border-bottom:1px solid #333"><img src="./img/<?= $row['img'] ?>" style="width:100px;"></td>
                <td style="border-bottom:1px solid #333"><input type="text" name="text[]" value="<?= $row['text'] ?>">
                </td>
                <td style="border-bottom:1px solid #333">
                    <button class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>">往上</button>
                    <button class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == $num) ? $row['id'] : $rows[$idx + 1]['id'] ?>">往下</button>
                </td>
                <td style="border-bottom:1px solid #333">
                    <select name="ani[]" id="">
                        <option value="1" <?= ($row['ani'] == 1) ? "selected" : "" ?>>淡入淡出</option>
                        <option value="2" <?= ($row['ani'] == 2) ? "selected" : "" ?>>滑入滑出</option>
                        <option value="3" <?= ($row['ani'] == 3) ? "selected" : "" ?>>縮放</option>
                    </select>
                    <br>
                    <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>"
                        <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示
                    <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">刪除
                    <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="ct" style="padding:2px;background:#eee"><input type="submit" value="編輯確定"> | <input type="reset"
            value="重置">
    </div>
</form>
<h3 class="ct wx">新增預告片海報</h3>
<form action="./api/new_poster.php?do=poster" method="post" enctype="multipart/form-data">
    <table style="width:100%;border:1px solid #999;margin:10px auto;">
        <tr>
            <th class="rb">預告片海報 : </td>
            <td><input type="file" name="img" id=""></td>
            <th class="rb">預告片片名 : </td>
            <td><input type="text" name="text" id=""></td>
        </tr>
        <tr>
            <td colspan="4" class="ct"><input type="submit" value="新增"> | <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
<script>
$('.sw').on('click', function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    $.post('./api/sw.php?do=poster', {
        id,
        sw
    }, () => {
        location.reload();
    })
})
</script>