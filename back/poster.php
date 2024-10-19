<style>
    table,
    tr,
    th,
    td {
        border-collapse: collapse;
    }

    table {
        background: #999;

        tr {
            box-shadow: inset 10px 10px 100px #000;
        }
    }
</style>
<h3 class="wx ct">預告片清單</h3>
<div style="height:250px;overflow:auto;">
    <form action="./api/edit.php?do=<?= $do ?>" method="post">
        <table>
            <tr>
                <th class="rb" width="30%">預告片海報</th>
                <th class="rb" width="30%">預告片片名</th>
                <th class="rb">預告片排序</th>
                <th class="rb">操作</th>
            </tr>
            <?php
            $rows = $DB->all("order by rank");
            foreach ($rows as $idx => $row) {
            ?>
                <tr class="w">
                    <td class="ct"><img src="./img/<?= $row['img'] ?>" style="width:40%"></td>
                    <td class="ct"><input type="text" name="name[]" value="<?= $row['name'] ?>"></td>
                    <td class="ct"><input type="button" value="往上" onclick="sw(<?= $row['id'] ?>,<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>)"> <input type="button" value="往下" onclick="sw(<?= $row['id'] ?>,<?= ($idx == (count($rows) - 1)) ? $row['id'] : $rows[$idx + 1]['id'] ?>)"></td>
                    <td class="ct">
                        <select name="ani[]">
                            <option value="1" <?= ($row['ani'] == 1) ? "selected" : "" ?>>淡入淡出</option>
                            <option value="2" <?= ($row['ani'] == 2) ? "selected" : "" ?>>滑入滑出</option>
                            <option value="3" <?= ($row['ani'] == 3) ? "selected" : "" ?>>縮放</option>
                        </select><br>
                        <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>" <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示<input type="checkbox" name="del[]" value="<?= $row['id'] ?>">刪除
                    </td>
                    <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                </tr>
            <?php
            }
            ?>
        </table>
</div>
<div class="ct" style="margin:5px;"><input type="submit" value="編輯確定"> <input type="reset" value="重置"></div>
</form>
<h3 class="wx ct">新增預告片海報</h3>
<form action="./api/add.php?do=<?= $do ?>" method="post" enctype="multipart/form-data">
    <table width="95%" style="margin:auto;box-shadow:0 0 10px #666;">
        <tr>
            <td class="ct">預告片海報:</td>
            <td class="ct"><input type="file" name="img" id=""></td>
            <td class="ct">預告片片名:</td>
            <td class="ct"><input type="text" name="name" id=""></td>
        </tr>
        <tr>
            <td colspan="4" class="ct"><input type="submit" value="新增"> <input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
<script>
    function sw(id, sw) {
        $.post('./api/sw.php?do=<?= $do ?>', {
            id,
            sw
        }, () => {
            location.reload();
        })
    }
</script>