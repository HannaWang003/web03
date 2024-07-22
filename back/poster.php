<?php
$rows = $Poster->all("order by rank");
$total = count($rows);
?>
<style>
#row {
    height: 180px;
    overflow: auto;

    td {
        text-align: center;
        border-bottom: 1px solid #eee;
        box-sizing: border-box;
        padding: 5px 10px;
    }
}

#addPoster {
    width: 90%;
    margin: auto;
    display: flex;

    div:nth-child(odd) {
        width: 40%;
        margin: 0 20px;
    }
}
</style>
<h2 class="ct wx">預告片清單</h2>
<form action="./api/save_poster.php" method="post">
    <div id="row">
        <table class="ts">
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
                <td><img src="./img/<?= $row['img'] ?>" style="width:50%;"></td>
                <td><input type="text" name="name[]" value="<?= $row['name'] ?>"></td>
                <td>
                    <button class="sw" data-id=<?= $row['id'] ?>
                        data-sw=<?= ($idx <= 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>>往上</button><button class="sw"
                        data-id=<?= $row['id'] ?>
                        data-sw=<?= ($idx >= $total - 1) ? $row['id'] : $rows[$idx + 1]['id'] ?>>往下</button>
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
<h2 class="ct wx">新增預告片海報</h2>
<form action="./api/save_poster.php" method="post" enctype="multipart/form-data">
    <div id="addPoster">
        <div>預告片海報：</div>
        <div><input type="file" name="img" id="img"></div>
        <div>預告片片名：</div>
        <div><input type="text" name="name" id="name"></div>
    </div>
    <div class="ct"><input type="submit" value="新增"><input type="reset" value="重置"></div>
</form>
<script>
$('.sw').on('click', function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    $.post('./api/sw.php', {
        id,
        sw,
        table: "poster"
    }, () => {
        location.reload();
    })
})
</script>