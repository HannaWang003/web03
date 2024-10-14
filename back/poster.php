<style>
    table,
    tr,
    td {
        border-collapse: collapse;
    }

    td {
        background: #eee;
        color: #333;
        border-bottom: 1px solid #333;
        padding: 10px 20px;
    }

    table {
        width: 100%;
    }
</style>
<h3 class="ct wx">預告片清單</h3>
<form action="./api/edit_poster.php?do=<?= $do ?>" method="post">
    <div style="height:200px;overflow:auto;">
        <table>
            <tr>
                <th class="rb" width="20%">預告片海報</th>
                <th class="rb" width="35%">預告片片名</th>
                <th class="rb" width="25%">預告片排序</th>
                <th class="rb" width="20%">操作</th>
            </tr>
            <?php
            $max = $DB->count() - 1;
            $rows = $DB->all("order by rank");
            foreach ($rows as $idx => $row) {
            ?>
                <tr>
                    <td><img src="./img/<?= $row['img'] ?>" style="width:90%"></td>
                    <td><input type="text" name="name[]" value="<?= $row['name'] ?>"></td>
                    <td>
                        <input type="button" value="往上"
                            onclick="sw(<?= $row['id'] ?>,<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>)">
                        <input type="button" value="往下"
                            onclick="sw(<?= $row['id'] ?>,<?= ($idx == $max) ? $row['id'] : $rows[$idx + 1]['id'] ?>)">
                    </td>
                    <td>
                        <select name="ani[]" id="">
                            <option value="1" <?= ($row['ani'] == 1) ? "selected" : "" ?>>淡入淡出</option>
                            <option value="2" <?= ($row['ani'] == 2) ? "selected" : "" ?>>滑入滑出</option>
                            <option value="3" <?= ($row['ani'] == 3) ? "selected" : "" ?>>縮放</option>
                        </select><br>
                        <input type="checkbox" name="sh[]" value="<?= $row['id'] ?>"
                            <?= ($row['sh'] == 1) ? "checked" : "" ?>>顯示 <input type="checkbox" name=del[]
                            value="<?= $row['id'] ?>">刪除
                        <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <div class="ct"><input type="submit" value="編輯確定"><input type="reset" value="重置"></div>
</form>
<h3 class="ct wx">新增預告片</h3>
<form action="./api/edit_poster.php?do=<?= $do ?>" method="post" enctype="multipart/form-data">
    <style>
        #new {
            td {
                padding: 5px;
            }
        }
    </style>
    <table id="new">
        <tr>
            <td>預告片海報 : </td>
            <td><input type="file" name="img" id="img"></td>
            <td>預告片片名 : </td>
            <td><input type="text" name="name" id="name"></td>
        </tr>
        <tr>
            <td colspan="4" class="ct"><input type="submit" value="新增"><input type="reset" value="重置"></td>
        </tr>
    </table>
</form>
<script>
    function sw(id, sw) {
        $.post('./api/sw.php?do=<?= $do ?>', {
            id,
            sw
        }, (res) => {
            location.reload();
        })
    }

    function sh(id, sh) {
        $.post('./api/sh.php?do=<?= $do ?>', {
            id,
            sh
        }, () => {
            location.reload();
        })
    }
</script>