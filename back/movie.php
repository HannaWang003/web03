<style>
    table,
    tr,
    th,
    td {
        border-collapse: collapse;
    }

    table {

        tr {
            background: linear-gradient(#0002, #0fe2);
            box-shadow: inset 10px 10px 100px #000;
        }
    }

    .sc {
        border: 5px solid #0f0;
    }
</style>
<div><input type="button" value="新增電影" onclick="location.href='?do=add_movie'"></div>
<hr>
<table>
    <?php
    $rows = $DB->all("order by rank");
    foreach ($rows as $idx => $row) {
    ?>
        <tr class="w">
            <td class="ct" width="20%"><img src="./img/<?= $row['poster'] ?>" style="width:80%;box-shadow:0 0 10px #0fe8"></td>
            <td>分級 : <img src="./icon/03C0<?= $row['level'] ?>.png" alt=""> </td>
            <td>
                <div style="display:flex;justify-content:space-between;">
                    <div>片名 : <?= $row['name'] ?></div>
                    <div>片長 : <?= $row['length'] ?></div>
                    <div>上映時間 : <?= $row['ondate'] ?></div>
                </div>
                <div style="text-align:end;">
                    <input type="button" value="往上" onclick="sw(<?= $row['id'] ?>,<?= ($idx == 0) ? $row['id'] : $rows[$idx - 1]['id'] ?>)">
                    <input type="button" value="往下" onclick="sw(<?= $row['id'] ?>,<?= ($idx == (count($rows) - 1)) ? $row['id'] : $rows[$idx + 1]['id'] ?>)">
                    <?php
                    $style = ($row['sh'] == 1) ? "" : "background:transparent;border:1px dotted #fff;color:#aaa;";
                    ?>
                    <input type="button" value="<?= ($row['sh'] == 1) ? "顯示" : "隱藏" ?>" onclick="sh(<?= $row['id'] ?>,<?= ($row['sh'] == 1) ? 0 : 1 ?>)" style="<?= $style ?>">
                    <input type="button" value="刪除電影" onclick="del(this,<?= $row['id'] ?>)">
                    <input type="button" value="編輯電影" onclick="location.href='?do=edit_movie&id=<?= $row['id'] ?>'">
                </div>
                <div>劇情介紹 : <?= $row['intro'] ?></div>
            </td>
        </tr>
    <?php
    }
    ?>
</table>
<script>
    $('tr').hover(function() {
        $(this).addClass('sc');
    }, () => {
        $('tr').removeClass('sc');
    })

    function sw(id, sw) {
        $.post('./api/sw.php?do=<?= $do ?>', {
            id,
            sw
        }, () => {
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

    function del(dom, id) {
        $.post('./api/del.php?do=<?= $do ?>', {
            id
        }, () => {
            $(dom).parents('tr').remove();
        })
    }
</script>