<style>
input[type='button'],
input[type='submit'],
input[type='reset'] {
    padding: 5px 10px;
    font-size: 16px;
}

th {
    background: #999;
    padding: 5px 10px;
}

td {
    border-bottom: 1px solid #eee;
    padding: 15px
}
</style>
<h3 class="ct wx">預告片清單</h3>
<form action="./api/save_poster.php" method="post">
    <div style="height:200px;overflow:auto">
        <table style="width:100%;text-align:center;" class="rb">
            <tr>
                <th>預告片海報</th>
                <th>預告片片名</th>
                <th>預告片排序</th>
                <th>操作</th>
            </tr>
            <?php
            $rows = $Poster->all("order by rank");
            $total = count($rows);
            foreach ($rows as $idx => $row) {
                if ($row['sh'] == 1) {
                    $s = "color:#fff";
                    $h = "color:#666";
                } else {
                    $s = "color:#666";
                    $h = "color:#fff";
                }


            ?>
            <tr>
                <td>
                    <img src="./img/<?= $row['img'] ?>" style="width:100px;">
                </td>
                <td><input type="text" name="name[]" value="<?= $row['name'] ?>"></td>
                <td>
                    <input type="button" class='sw' data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>" value="往上">
                    <input type="button" class='sw' data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx == $total - 1) ? $row['id'] : $rows[$idx + 1]['id'] ?>" value="往下">
                </td>
                <td><input type="checkbox" name="sh[]" value="<?= $row['id'] ?>"
                        <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示
                    <input type="checkbox" name="del[]" value="<?= $row['id'] ?>">刪除
                </td>
            </tr>
            <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
            <?php
            }
            ?>
        </table>
    </div>
    <div class="ct"><input type="submit" value="編輯確定"> <input type="reset" value="重置"></div>
</form>
<div>
    <h3 class="ct wx">新增預告片海報</h3>
    <form action="./api/save_poster.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>預告片海報：</td>
                <td><input type="file" name="img" id="img"></td>
                <td>預告片片名：</td>
                <td><input type="text" name="name" id="name"></td>
            </tr>
        </table>
        <div class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></div>
    </form>
</div>
<script>
$('.sw').on('click', function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    let table = "poster";
    $.post('./api/sw.php', {
        table,
        id,
        sw
    }, () => {
        location.reload();
    })
})
</script>