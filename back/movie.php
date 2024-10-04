<button onclick="location.href='?do=add_movie'">新增電影</button>
<hr>
<div style="height:400px;overflow:auto;">
    <table width="100%;">
        <?php
        $rows = $DB->all("order by rank");
        $end = $DB->count() - 1;
        foreach ($rows as $idx => $row) {
        ?>
            <tr>
                <td style="border-bottom:1px solid #eee"><img src="./img/<?= $row['poster'] ?>" style="width:100px">
                </td>
                <td style="border-bottom:1px solid #eee">分級 : <img src="./icon/03C0<?= $row['level'] ?>.png"
                        style="with:25px">
                </td>
                <td style="border-bottom:1px solid #eee;vertical-align:top;">
                    <div style="display:flex;justify-content:space-between;">
                        <div>片名 : <?= $row['name'] ?></div>
                        <div>片長 : <?= $row['length'] ?></div>
                        <div>上映時間 : <?= $row['ondate'] ?></div>
                    </div>
                    <div style="text-align:end;">
                        <button onclick="sh(<?= $row['id'] ?>)"><?= ($row['sh'] == 1) ? "顯示" : "隱藏" ?></button>
                        <button
                            onclick="sw(<?= $row['id'] ?>,<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>)">往上</button>
                        <button
                            onclick="sw(<?= $row['id'] ?>,<?= ($idx == $end) ? $row['id'] : $rows[$idx + 1]['id'] ?>)">往下</button>
                        <button onclick="location.href='?do=edit_movie&id=<?= $row['id'] ?>'">編緝電影</button> <button
                            onclick="del(this,<?= $row['id'] ?>)">刪除電影</button>
                    </div>
                    <div>劇情介紹: <?= $row['intro'] ?></div>
                </td>
            </tr>
            <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
        <?php
        }
        ?>
    </table>
</div>
<script>
    function sw(id, sw) {
        $.post('./api/sw.php?do=<?= $table ?>', {
            id,
            sw
        }, () => {
            location.reload();
        })
    }

    function sh(id) {
        $.post('./api/sh.php?do=<?= $table ?>', {
            id
        }, () => {
            location.reload();
        })
    }

    function del(dom, id) {
        $.post('./api/del.php?do=<?= $table ?>', {
            id
        }, () => {
            $(dom).parents('tr').remove();
        })
    }
</script>