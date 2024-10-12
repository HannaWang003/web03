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
</style>
<h3 class="ct wx">院線片清單</h3>
<input type="button" value="新增電影" onclick="location.href='?do=new_movie'">
<table width="100%">
    <?php
    $rows = $DB->all("order by rank");
    $max = $DB->count() - 1;
    foreach ($rows as $idx => $row) {
    ?>
        <tr>
            <td width="20%;"><img src="./img/<?= $row['poster'] ?>" style="width:90%;box-shadow:0 0 5px #999;"></td>
            <td width="15%;">分級 : <img src="./icon/03C0<?= $row['level'] ?>.png" style="width:25px"></td>
            <td>
                <div style="display:flex;justify-content:space-between;">
                    <div>片名 : <?= $row['name'] ?></div>
                    <div>片長 : <?= $row['length'] ?></div>
                    <div>上映日期 : <?= $row['ondate'] ?></div>
                </div>
                <div>
                    <input type="button" value="<?= ($row['sh'] == 1) ? "顯示" : "隱藏" ?>"
                        onclick="sh(<?= $row['id'] ?>,<?= ($row['sh'] == 1) ? 0 : 1 ?>)">
                    <input type="button" value="往上"
                        onclick="sw(<?= $row['id'] ?>,<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>)">
                    <input type="button" value="往下"
                        onclick="sw(<?= $row['id'] ?>,<?= ($idx == $max) ? $row['id'] : $rows[$idx + 1]['id'] ?>)">
                    <input type="button" value="編輯電影">
                    <input type="button" value="刪除電影" onclick="del(<?= $row['id'] ?>)">
                </div>
                <div><?= $row['intro'] ?></div>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<script>
    $('input[value="隱藏"]').attr('style', 'color: #666;background:transparent;border:1px dotted #666;');

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

    function del(id) {
        $.post('./api/del.php?do=<?= $do ?>', {
            id,
        }, () => {
            location.reload();
        })
    }
</script>