<div class="ct rb" style="padding:5px;"><b>預告片清單</b></div>
<div style="height:250px;overflow:auto;">
    <form action="./api/edit_poster.php" method="post">
        <table style="width:95%;margin:auto;">
            <tr>
                <th>預告片海報</th>
                <th>預告片片名</th>
                <th>預告片排序</th>
                <th>操作</th>
            </tr>
            <style>
            table {
                border-collapse: collapse;
            }

            tr {
                border-bottom: 1px solid #333;

            }

            td {
                padding: 10px;
            }
            </style>
            <?php
            $rows = $Poster->all("order by rank");
            $total = $Poster->count();
            if (!empty($rows)) {
                foreach ($rows as $idx => $row) {
            ?>
            <tr style="background:#999;">
                <td style="text-align:center"><img src="./img/<?= $row['img'] ?>" style="width:100px"></td>
                <td><input type="text" name="name[]" value="<?= $row['name'] ?>"></td>
                <td style="text-align:center">
                    <input type="button" class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx > 0) ? $rows[$idx - 1]['id'] : $row['id'] ?>" value="往上">
                    <input type="button" class="sw" data-id="<?= $row['id'] ?>"
                        data-sw="<?= ($idx < $total - 1) ? $rows[$idx + 1]['id'] : $row['id']   ?>" value="往下">
                </td>
                <td style="text-align:center">
                    <select name="ani[]" id="">
                        <option value="1" <?= ($row['ani'] == 1) ? "selected" : "" ?>>淡入淡出</option>
                        <option value="2" <?= ($row['ani'] == 2) ? "selected" : "" ?>>滑入滑出</option>
                        <option value="3" <?= ($row['ani'] == 3) ? "selected" : "" ?>>縮放(小到大)</option>
                    </select>
                    <br>
                    <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>"
                        <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示 | <input type="checkbox" name="del[]"
                        value="<?= $row['id'] ?>">刪除
                </td>
            </tr>
            <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
            <?php
                }
            }
            ?>
        </table>
</div>
<div class="ct"><input type="submit" value="編輯確定"> <input type="reset" value="重置"></div>
</form>
<hr>
<div class="ct rb" style="padding:5px;"><b>新增預告片海報</b></div>
<form action="./api/add.php" method="post" enctype="multipart/form-data">
    <table style="width:95%;margin:auto">
        <tr>
            <td>
                <label>預告片海報: </label><input type="file" name="img" id="">
            </td>
            <td>
                <label>預告片片名: </label><input type="text" name="name" id="">
            </td>
        </tr>
    </table>
    <input type="hidden" name="table" value="<?= $_GET['do'] ?>">
    <div class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></div>
</form>
<script>
$('.sw').on('click', function() {
    let id = $(this).data('id');
    let sw = $(this).data('sw');
    $.get('./api/sw.php', {
        id,
        sw,
        table: "poster"
    }, (res) => {
        location.reload();
    })
})
</script>