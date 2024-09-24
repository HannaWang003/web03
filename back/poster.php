<?php
$rows = $DB->all("order by rank");
$total = $DB->count();
?>
<h3 class="ct wx">預告片清單</h3>
<form action="./api/edit_poster.php?do=poster" method="post">
    <div style="height:200px;overflow:auto;">
        <table style="width:100%;margin:auto;background:#aaa;">
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
                <th style="border-bottom:1px solid #333"><img src="./img/<?= $row['img'] ?>" style="width:80px;"></th>
                <th style="border-bottom:1px solid #333"><input type="text" name="text[]" value="<?= $row['text'] ?>">
                </th>
                <th style="border-bottom:1px solid #333">
                    <button
                        onclick="sw(<?= $row['id'] ?>,<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>)">往上</button>
                    <button
                        onclick="sw(<?= $row['id'] ?>,<?= ($idx == $total - 1) ? $row['id'] : $rows[$idx + 1]['id'] ?>)">往下</button>
                </th>
                <th style="border-bottom:1px solid #333">
                    <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>"
                        <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示
                    <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">刪除
                    <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                </th>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="ct" style="padding:10px;"><input type="submit" value="修改確定"> <input type="reset" value="重置"></div>
</form>
<h3 class="ct wx">新增預告片海報</h3>
<form action="./api/add_poster.php?do=poster" method="post" enctype="multipart/form-data">
    <table style="width:100%;padding:10px;border:1px solid #333;">
        <tr>
            <th class="rb">預告片海報 : </th>
            <td><input type="file" name="img" id=""></td>
            <th class="rb">預告片片名 : </th>
            <td><input type="text" name="text" id=""></td>
        </tr>
        <tr>
            <th colspan="4"><input type="submit" value="新增"> <input type="reset" value="重置"></th>
        </tr>
    </table>
</form>
<script>
function sw(id, sw) {
    $.post('./api/sw.php?do=<?=$table?>', {
        id,
        sw
    }, () => {
        locaiton.reload();
    })
}
</script>